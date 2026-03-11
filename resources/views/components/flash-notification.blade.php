@if (session('success'))
    <div id="flash-notification"
        class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-100 border border-green-400 text-green-800 px-6 py-4 rounded-lg shadow-lg w-fit max-w-md z-50 flex items-center space-x-3 animate-slide"
        role="alert">
        <i data-lucide="circle-check-big" class="h-5 w-5 text-green-700 flex-shrink-0"></i>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
@elseif (session('error'))
    <div id="flash-notification"
        class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-red-100 border border-red-400 text-red-800 px-6 py-4 rounded-lg shadow-lg w-fit max-w-md z-50 flex items-center space-x-3 animate-slide"
        role="alert">
        <i data-lucide="alert-circle" class="h-5 w-5 text-red-700 flex-shrink-0"></i>
        <span class="text-sm font-medium">{{ session('error') }}</span>
    </div>
@elseif (session('warning'))
    <div id="flash-notification"
        class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-yellow-100 border border-yellow-400 text-yellow-800 px-6 py-4 rounded-lg shadow-lg w-fit max-w-md z-50 flex items-center space-x-3 animate-slide"
        role="alert">
        <i data-lucide="alert-triangle" class="h-5 w-5 text-yellow-700 flex-shrink-0"></i>
        <span class="text-sm font-medium">{{ session('warning') }}</span>
    </div>
@elseif (session('info'))
    <div id="flash-notification"
        class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-blue-100 border border-blue-400 text-blue-800 px-6 py-4 rounded-lg shadow-lg w-fit max-w-md z-50 flex items-center space-x-3 animate-slide"
        role="alert">
        <i data-lucide="info" class="h-5 w-5 text-blue-700 flex-shrink-0"></i>
        <span class="text-sm font-medium">{{ session('info') }}</span>
    </div>
@elseif ($errors->any())
    <div id="flash-notification"
        class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-red-100 border border-red-400 text-red-800 px-6 py-4 rounded-lg shadow-lg w-fit max-w-md z-50 flex items-center space-x-3 animate-slide"
        role="alert">
        <i data-lucide="alert-triangle" class="h-5 w-5 text-red-700 flex-shrink-0"></i>
        <span class="text-sm font-medium">
            @if ($errors->count() === 1)
                {{ $errors->first() }}
            @else
                Por favor, verifique os erros no formulário.
            @endif
        </span>
    </div>
@endif

<script>
    // Auto-close notification with smooth fade out
    document.addEventListener('DOMContentLoaded', function() {
        const notification = document.getElementById('flash-notification');
        if (notification) {
            // Prepara a notificação para animação
            notification.style.transition = 'all 0.5s ease-in-out';

            setTimeout(() => {
                // Trigger fade out
                notification.style.opacity = '0';
                notification.style.transform = 'translateX(-50%) translateY(-20px)';
                notification.style.pointerEvents = 'none';

                // Remove após animação
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 500);
            }, 4500); // 4.5s visível + 0.5s fade = 5s total
        }
    });
</script>
