<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\Empresa;
use App\Models\CadastradoReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class RewardController extends Controller
{
    /**
     * Exibe a "dashboard" pública com recompensas disponíveis
     */
    public function dashboard()
    {
        $rewards = Reward::where("qtd_disponivel", ">", 0)->latest()->paginate(9);
        return view("rewards.dashboard", compact("rewards"));
    }

    /**
     * Exibe os detalhes de uma recompensa específica
     */
    public function show(Reward $reward)
    {
        return view("rewards.show", compact("reward"));
    }

    /**
     * Exibe a tabela de gerenciamento para ADMIN
     */
    public function index(Request $request)
    {
        // Verifica se é admin
        if (Auth::user()->nivel_permissao !== "admin") {
            abort(403, 'Apenas administradores podem acessar esta página.');
        }

        $query = Reward::query();

        // Sistema de busca
        $searchTerm = $request->input('search', '');
        $searchFields = $request->input('fields', []);

        if ($searchTerm && !empty($searchFields)) {
            $query->where(function ($q) use ($searchTerm, $searchFields) {
                if (in_array('titulo', $searchFields)) {
                    $q->orWhere('titulo', 'like', '%' . $searchTerm . '%');
                }
                if (in_array('descricao', $searchFields)) {
                    $q->orWhere('descricao', 'like', '%' . $searchTerm . '%');
                }
                if (in_array('empresa', $searchFields)) {
                    $q->orWhereHas('empresa.user', function ($empresaQuery) use ($searchTerm) {
                        $empresaQuery->where('name', 'like', '%' . $searchTerm . '%');
                    });
                }
            });
        }

        $rewards = $query->latest()->paginate(12)->withQueryString();

        return view("rewards.index", compact("rewards"));
    }

    /**
     * Mostra o formulário para criar uma nova recompensa (APENAS EMPRESA)
     */
    public function create()
    {
        $user = Auth::user();
        
        // Apenas empresas podem criar recompensas
        if ($user->nivel_permissao !== "empresa") {
            abort(403, "Apenas empresas podem criar recompensas.");
        }

        $empresaId = $user->empresa->id;
        return view("rewards.create", compact("empresaId"));
    }

    /**
     * Armazena uma nova recompensa no banco de dados (APENAS EMPRESA)
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        // Apenas empresas podem criar recompensas
        if ($user->nivel_permissao !== "empresa") {
            abort(403, "Apenas empresas podem criar recompensas.");
        }

        $validatedData = $request->validate([
            "titulo" => "required|string|max:200",
            "descricao" => "nullable|string",
            "pontos_necessarios" => "required|integer|min:0",
            "qtd_disponivel" => "required|integer|min:0",
            "img_recompensa" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);

        // Associa automaticamente à empresa do usuário
        $validatedData["empresa_id"] = $user->empresa->id;

        // Processa o upload da imagem
        if ($request->hasFile("img_recompensa")) {
            $path = $request->file("img_recompensa")->store("rewards", "public");
            $validatedData["img_recompensa"] = $path;
        }

        Reward::create($validatedData);

        return redirect()->route("rewards.my")->with("success", "Recompensa criada com sucesso!");
    }

    /**
     * Mostra o formulário para editar uma recompensa (ADMIN E EMPRESA)
     */
    public function edit(Reward $reward)
    {
        $user = Auth::user();
        
        // Apenas admin e empresa podem editar
        if (!in_array($user->nivel_permissao, ["admin", "empresa"])) {
            abort(403, "Apenas administradores e empresas podem editar recompensas.");
        }

        // Se for empresa, verifica se a recompensa é dela
        if ($user->nivel_permissao === "empresa" && $reward->empresa_id !== $user->empresa->id) {
            abort(403, "Você só pode editar recompensas da sua empresa.");
        }

        $empresas = $user->nivel_permissao === "admin" ? Empresa::all() : collect();

        return view("rewards.edit", compact("reward", "empresas"));
    }

    /**
     * Atualiza uma recompensa no banco de dados (ADMIN E EMPRESA)
     */
    public function update(Request $request, Reward $reward)
    {
        $user = Auth::user();
        
        // Apenas admin e empresa podem atualizar
        if (!in_array($user->nivel_permissao, ["admin", "empresa"])) {
            abort(403, "Apenas administradores e empresas podem atualizar recompensas.");
        }

        // Se for empresa, verifica se a recompensa é dela
        if ($user->nivel_permissao === "empresa" && $reward->empresa_id !== $user->empresa->id) {
            abort(403, "Você só pode atualizar recompensas da sua empresa.");
        }

        $validatedData = $request->validate([
            "titulo" => "required|string|max:200",
            "descricao" => "nullable|string",
            "pontos_necessarios" => "required|integer|min:0",
            "qtd_disponivel" => "required|integer|min:0",
            "img_recompensa" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);

        // Gerencia a substituição da imagem
        if ($request->hasFile("img_recompensa")) {
            if ($reward->img_recompensa) {
                Storage::disk("public")->delete($reward->img_recompensa);
            }
            $path = $request->file("img_recompensa")->store("rewards", "public");
            $validatedData["img_recompensa"] = $path;
        }

        $reward->update($validatedData);

        // Redirecionamento condicional
        if ($user->nivel_permissao === "admin") {
            return redirect()->route("rewards.index")->with("success", "Recompensa atualizada com sucesso!");
        } else {
            return redirect()->route("rewards.my")->with("success", "Recompensa atualizada com sucesso!");
        }
    }

    /**
     * Remove uma recompensa do banco de dados (ADMIN E EMPRESA)
     */
    public function destroy(Reward $reward)
    {
        $user = Auth::user();
        
        // Apenas admin e empresa podem excluir
        if (!in_array($user->nivel_permissao, ["admin", "empresa"])) {
            abort(403, "Apenas administradores e empresas podem excluir recompensas.");
        }

        // Se for empresa, verifica se a recompensa é dela
        if ($user->nivel_permissao === "empresa" && $reward->empresa_id !== $user->empresa->id) {
            abort(403, "Você só pode excluir recompensas da sua empresa.");
        }

        // Remove a imagem associada se existir
        if ($reward->img_recompensa) {
            Storage::disk("public")->delete($reward->img_recompensa);
        }

        $reward->delete();

        // Redirecionamento condicional
        if ($user->nivel_permissao === "admin") {
            return redirect()->route("rewards.index")->with("success", "Recompensa excluída com sucesso!");
        } else {
            return redirect()->route("rewards.my")->with("success", "Recompensa excluída com sucesso!");
        }
    }

    /**
     * Exibe as recompensas gerenciadas pela empresa logada (APENAS EMPRESA)
     */
    public function myRewards(Request $request)
    {
        $user = Auth::user();
        $empresa = $user->empresa;

        // Apenas empresas podem acessar
        if ($user->nivel_permissao !== "empresa") {
            abort(403, "Apenas empresas podem acessar esta página.");
        }
        
        $query = $empresa->rewards();

        // Sistema de busca
        $searchTerm = $request->input("search", "");
        $searchFields = $request->input("fields", []);

        if ($searchTerm && !empty($searchFields)) {
            $query->where(function ($q) use ($searchTerm, $searchFields) {
                if (in_array("titulo", $searchFields)) {
                    $q->orWhere("titulo", "like", "%" . $searchTerm . "%");
                }
                if (in_array("descricao", $searchFields)) {
                    $q->orWhere("descricao", "like", "%" . $searchTerm . "%");
                }
            });
        }

        $rewards = $query->latest()->paginate(12)->withQueryString();

        return view("rewards.my-rewards", compact("rewards"));
    }

    /**
     * Permite que um usuário cadastrado resgate uma recompensa (APENAS CADASTRADO)
     */
    public function redeem(Request $request, Reward $reward)
    {
        $user = Auth::user();
        $cadastrado = $user->cadastrado;

        if ($user->nivel_permissao !== "cadastrado") {
            return redirect()->back()->with('error', 'Apenas usuários cadastrados podem resgatar recompensas.');
        }

        try {
            DB::transaction(function () use ($cadastrado, $reward) {
                if ($reward->qtd_disponivel <= 0) {
                    throw new \Exception("Recompensa esgotada.");
                }

                if ($cadastrado->pontos_disponiveis < $reward->pontos_necessarios) {
                    throw new \Exception("Pontos insuficientes para resgatar esta recompensa.");
                }

                // Cria o resgate com código e data de expiração
                $resgate = CadastradoReward::create([
                    'cadastrado_id' => $cadastrado->id,
                    'reward_id' => $reward->id,
                    'codigo_resgate' => CadastradoReward::gerarCodigoResgateUnico(),
                    'data_expiracao' => now()->addDays(7),
                    'status' => 'pendente',
                    'pontos_gastos' => $reward->pontos_necessarios,
                ]);

                // Atualiza estoque e pontos
                $reward->decrement('qtd_disponivel');
                $cadastrado->increment('pontuacao_gasta', $reward->pontos_necessarios);
            });

            return redirect()->route('resgates.index')
                ->with('success', 'Recompensa resgatada com sucesso! Use o código gerado em até 7 dias.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}