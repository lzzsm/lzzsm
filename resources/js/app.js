import './bootstrap';

lucide.createIcons();

// JavaScript geral de layouts

document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('toggleSidebarBtn');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const globalFooter = document.getElementById('globalFooter');
    let isOpen = false;

    //=================
    // TOGGLE BUTTON (hamburger ↔ X)
    //=================
    toggleBtn.addEventListener('click', () => {
        isOpen = !isOpen;

        // Sidebar classes
        if (isOpen) {
            sidebar.classList.remove('opacity-0', 'pointer-events-none', '-translate-x-full');
            sidebar.classList.add('opacity-100', 'pointer-events-auto', 'translate-x-0');
            mainContent.classList.add('sidebar-open');
            globalFooter.classList.add('sidebar-open');
        } else {
            sidebar.classList.remove('opacity-100', 'pointer-events-auto', 'translate-x-0');
            sidebar.classList.add('opacity-0', 'pointer-events-none', '-translate-x-full');
            mainContent.classList.remove('sidebar-open');
            globalFooter.classList.remove('sidebar-open');
        }

        // Botão: hamburguer ↔ X
        toggleBtn.querySelectorAll('.line').forEach(l => l.classList.toggle('scale-0', isOpen));
        toggleBtn.querySelectorAll('.x-line').forEach(l => l.classList.toggle('scale-0', !isOpen));
    });

    //=================
    // DROPDOWNS
    //=================
    const toggles = document.querySelectorAll('.dropdown-toggle');

    toggles.forEach(toggle => {
        toggle.addEventListener('click', (e) => {
            e.stopPropagation();
            const parent = toggle.closest('.flex.flex-col');
            const content = parent.querySelector('.dropdown-content');
            const icon = toggle.querySelector('.dropdown-icon');
            const sidebarItem = toggle.closest('.sidebar-item');
            const isExpanded = content.classList.contains('open');

            // Fecha outros dropdowns e remove estado ativo
            document.querySelectorAll('.dropdown-content').forEach(dc => {
                if (dc !== content) {
                    dc.classList.remove('open');
                    dc.style.maxHeight = null;
                    dc.previousElementSibling?.querySelector('.dropdown-icon')?.classList.remove('active');
                    dc.closest('.flex.flex-col')?.querySelector('.sidebar-item')?.classList.remove('active');
                }
            });

            // Abre/fecha o atual
            if (isExpanded) {
                content.classList.remove('open');
                content.style.maxHeight = null;
                icon?.classList.remove('active');
                sidebarItem?.classList.remove('active');
            } else {
                content.classList.add('open');
                content.style.maxHeight = `${content.scrollHeight}px`;
                icon?.classList.add('active');
                sidebarItem?.classList.add('active');
            }
        });
    });

    // Atualize também o evento de clique fora
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.dropdown-toggle') && !e.target.closest('.dropdown-content') && !e.target.closest('.user-dropdown-toggle') && !e.target.closest('.user-dropdown-menu')) {
            document.querySelectorAll('.dropdown-content').forEach(content => {
                content.classList.remove('open');
                content.style.maxHeight = null;
                content.previousElementSibling?.querySelector('.dropdown-icon')?.classList.remove('active');
                content.closest('.flex.flex-col')?.querySelector('.sidebar-item')?.classList.remove('active');
            });
            // Close user dropdown if open
            const userDropdown = document.getElementById('userDropdown');
            if (userDropdown && userDropdown.classList.contains('open')) {
                userDropdown.classList.remove('open');
            }
        }
    });

    //=================
    // User Dropdown
    //=================
    const userDropdownToggle = document.getElementById('userDropdownToggle');
    const userDropdownMenu = document.getElementById('userDropdownMenu');

    if (userDropdownToggle && userDropdownMenu) {
        let isDropdownOpen = false;

        // Função para abrir/fechar
        const toggleDropdown = () => {
            isDropdownOpen = !isDropdownOpen;

            if (isDropdownOpen) {
                userDropdownMenu.classList.remove('opacity-0', 'pointer-events-none', '-translate-y-2');
                userDropdownMenu.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
            } else {
                userDropdownMenu.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                userDropdownMenu.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
            }
        };

        // Click no toggle
        userDropdownToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleDropdown();
        });

        // Fechar ao clicar fora
        document.addEventListener('click', (e) => {
            if (!userDropdownMenu.contains(e.target) && !userDropdownToggle.contains(e.target)) {
                userDropdownMenu.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                userDropdownMenu.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
                isDropdownOpen = false;
            }
        });

        // Fechar ao pressionar ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isDropdownOpen) {
                toggleDropdown();
            }
        });
    }
});



// JavaScript para interações e animações da landing page Perseph

document.addEventListener('DOMContentLoaded', function () {

    // Configuração do Intersection Observer para scroll reveal
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    // Observer para seções com fade-in
    const fadeObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // Observer para itens do timeline
    const timelineObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');

                // Adiciona delay escalonado para animação suave
                const delay = Array.from(entry.target.parentNode.children).indexOf(entry.target) * 200;
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateX(0)';
                }, delay);
            }
        });
    }, observerOptions);

    // Observer para cards adicionais
    const cardsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const delay = Array.from(entry.target.parentNode.children).indexOf(entry.target) * 100;
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, delay);
            }
        });
    }, observerOptions);

    // Observer para seção CTA
    const ctaObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');

                // Animar benefícios com delay
                const benefits = entry.target.querySelectorAll('.cta-benefit');
                benefits.forEach((benefit, index) => {
                    setTimeout(() => {
                        benefit.classList.add('visible');
                    }, 300 + (index * 200));
                });
            }
        });
    }, observerOptions);

    // Aplicar observers aos elementos
    const fadeElements = document.querySelectorAll('.fade-in-section');
    const timelineItems = document.querySelectorAll('.timeline-item');
    const additionalCards = document.querySelectorAll('.additional-card');
    const ctaSection = document.querySelector('.cta-section');

    fadeElements.forEach(el => fadeObserver.observe(el));
    timelineItems.forEach(el => timelineObserver.observe(el));
    additionalCards.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease';
        cardsObserver.observe(el);
    });

    // Observar seção CTA se existir
    if (ctaSection) {
        ctaObserver.observe(ctaSection);
    }

    // Animação de entrada do hero com delay
    setTimeout(() => {
        const heroSubtitle = document.querySelector('.hero-subtitle');
        const heroButtons = document.querySelector('.hero-buttons');

        if (heroSubtitle) {
            heroSubtitle.style.opacity = '1';
            heroSubtitle.style.transform = 'translateY(0)';
        }

        if (heroButtons) {
            heroButtons.style.opacity = '1';
            heroButtons.style.transform = 'translateY(0)';
        }
    }, 1000);

    // Animação de contagem para números (se houver)
    function animateCounter(element, target, duration = 2000) {
        let start = 0;
        const increment = target / (duration / 16);

        function updateCounter() {
            start += increment;
            if (start < target) {
                element.textContent = Math.floor(start);
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target;
            }
        }

        updateCounter();
    }

    // Smooth scroll para links internos
    const smoothScrollLinks = document.querySelectorAll('a[href^="#"]');

    smoothScrollLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Animação de hover para círculos do timeline
    const circles = document.querySelectorAll('.circle-pulse');

    circles.forEach(circle => {
        circle.addEventListener('mouseenter', function () {
            this.style.transform = 'scale(1.1)';
            this.style.transition = 'transform 0.3s ease';
        });

        circle.addEventListener('mouseleave', function () {
            this.style.transform = 'scale(1)';
        });
    });

    // Efeito de typing para texto (opcional)
    function typeWriter(element, text, speed = 50) {
        let i = 0;
        element.textContent = '';

        function type() {
            if (i < text.length) {
                element.textContent += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        }

        type();
    }

    // Animação de entrada escalonada para cards
    function staggerAnimation(elements, delay = 100) {
        elements.forEach((element, index) => {
            setTimeout(() => {
                element.classList.add('loading-fade');
            }, index * delay);
        });
    }

    // Aplicar animação escalonada aos cards do timeline
    const timelineCards = document.querySelectorAll('.timeline-item .bg-white');
    staggerAnimation(timelineCards, 200);

    // Efeito de mouse follow para elementos interativos
    let mouseX = 0;
    let mouseY = 0;

    document.addEventListener('mousemove', function (e) {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    // Animação de partículas flutuantes (opcional)
    function createFloatingParticle() {
        const particle = document.createElement('div');
        particle.style.cssText = `
            position: fixed;
            width: 4px;
            height: 4px;
            background: rgba(132, 204, 22, 0.6);
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
            animation: float-particle 8s linear infinite;
        `;

        particle.style.left = Math.random() * window.innerWidth + 'px';
        particle.style.top = window.innerHeight + 'px';

        document.body.appendChild(particle);

        setTimeout(() => {
            particle.remove();
        }, 8000);
    }

    // CSS para partículas flutuantes
    const particleStyle = document.createElement('style');
    particleStyle.textContent = `
        @keyframes float-particle {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(particleStyle);

    // Criar partículas periodicamente
    setInterval(createFloatingParticle, 2500);

    // Animação de loading da página
    window.addEventListener('load', function () {
        document.body.classList.add('loaded');

        // Remover qualquer overlay de loading se existir
        const loader = document.querySelector('.loader');
        if (loader) {
            loader.style.opacity = '50';
            setTimeout(() => loader.remove(), 500);
        }
    });

    // Otimização de performance para scroll
    let scrollTimeout;

    window.addEventListener('scroll', function () {
        if (scrollTimeout) {
            clearTimeout(scrollTimeout);
        }

        document.body.classList.add('scrolling');

        scrollTimeout = setTimeout(function () {
            document.body.classList.remove('scrolling');
        }, 100);
    });

    // Efeito de zoom suave nas imagens (se houver)
    const images = document.querySelectorAll('img');

    images.forEach(img => {
        img.addEventListener('load', function () {
            this.style.opacity = '1';
            this.style.transform = 'scale(1)';
        });

        // Preload com efeito suave
        if (!img.complete) {
            img.style.opacity = '0';
            img.style.transform = 'scale(0.9)';
            img.style.transition = 'all 0.5s ease';
        }
    });

    // Função para reiniciar animações quando necessário
    function restartAnimations() {
        const animatedElements = document.querySelectorAll('.visible');
        animatedElements.forEach(el => {
            el.classList.remove('visible');
            setTimeout(() => {
                el.classList.add('visible');
            }, 100);
        });
    }

    // Adicionar classe de carregamento inicial
    document.body.classList.add('loading-fade');
});

// Função utilitária para debounce
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Função utilitária para throttle
function throttle(func, limit) {
    let inThrottle;
    return function () {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}








// JavaScript geral

// Objeto principal para organizar o código
const CollectPointsApp = {
    // Função para configurar a busca do Dashboard
    initDashboard: function () {
        const searchInput = document.getElementById('searchInput');
        const pointCards = document.querySelectorAll('.point-card');

        // Verifica se o campo de busca existe na página
        if (searchInput) {
            searchInput.addEventListener('keyup', function (event) {
                const searchTerm = event.target.value.toLowerCase();

                pointCards.forEach(card => {
                    const cardText = card.getAttribute('data-search-text').toLowerCase();
                    // Mostra ou esconde o card com base na busca
                    card.style.display = cardText.includes(searchTerm) ? 'block' : 'none';
                });
            });
        }
    },

    // Função principal que inspeciona o DOM para decidir o que fazer
    init: function () {
        // Procura por elementos específicos do dashboard
        const searchInput = document.getElementById('searchInput');

        if (searchInput) {
            console.log("Modo Dashboard detectado. Inicializando busca.");
            this.initDashboard();
        } else {
            console.log("Nenhuma funcionalidade JS necessária para esta página.");
        }
    }
};

// Garante que o script só rode depois que a página carregar
document.addEventListener('DOMContentLoaded', function () {

    // Pega os elementos do DOM
    const searchInput = document.getElementById('searchInput');
    const pointsGrid = document.getElementById('points-grid');
    const pointCards = pointsGrid.querySelectorAll('.point-card'); // Busca os cards dentro da grid
    const noSearchResultsMessage = document.getElementById('no-search-results');

    // Só adiciona o listener se houver uma barra de busca na página
    if (searchInput) {
        searchInput.addEventListener('keyup', function () {
            const filter = searchInput.value.toLowerCase();
            let visibleCount = 0;

            pointCards.forEach(card => {
                const text = card.dataset.searchText;
                if (text.includes(filter)) {
                    card.style.display = ''; // Mostra o card
                    visibleCount++;
                } else {
                    card.style.display = 'none'; // Esconde o card
                }
            });

            // Mostra ou esconde a mensagem de "nenhum resultado"
            if (visibleCount === 0 && pointCards.length > 0) {
                noSearchResultsMessage.style.display = 'block';
            } else {
                noSearchResultsMessage.style.display = 'none';
            }
        });
    }
});

// Aguarda o DOM carregar e então inicializa o aplicativo
document.addEventListener('DOMContentLoaded', function () {
    CollectPointsApp.init();
});