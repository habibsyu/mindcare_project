import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Global JavaScript functionality
document.addEventListener('DOMContentLoaded', function() {
    
    // Auto-hide flash messages
    const flashMessages = document.querySelectorAll('.flash-message');
    flashMessages.forEach(message => {
        setTimeout(() => {
            message.style.transition = 'opacity 0.5s ease-out';
            message.style.opacity = '0';
            setTimeout(() => {
                message.remove();
            }, 500);
        }, 5000);
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Lazy loading for images
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('opacity-0');
                img.classList.add('opacity-100');
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));

    // Back to top button
    const backToTopButton = document.createElement('button');
    backToTopButton.innerHTML = '<i class="fas fa-arrow-up"></i>';
    backToTopButton.className = 'fixed bottom-4 right-4 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300 opacity-0 pointer-events-none z-50';
    backToTopButton.id = 'backToTop';
    document.body.appendChild(backToTopButton);

    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.remove('opacity-0', 'pointer-events-none');
            backToTopButton.classList.add('opacity-100', 'pointer-events-auto');
        } else {
            backToTopButton.classList.add('opacity-0', 'pointer-events-none');
            backToTopButton.classList.remove('opacity-100', 'pointer-events-auto');
        }
    });

    backToTopButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Form validation enhancement
    const forms = document.querySelectorAll('form[data-validate]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('border-red-500');
                    isValid = false;
                } else {
                    field.classList.remove('border-red-500');
                }
            });

            if (!isValid) {
                e.preventDefault();
                const firstInvalidField = form.querySelector('.border-red-500');
                if (firstInvalidField) {
                    firstInvalidField.focus();
                    firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    });

    // Content interaction handlers
    window.toggleLike = async function(contentId) {
        try {
            const response = await fetch(`/content/${contentId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
            });

            const data = await response.json();
            
            if (response.ok) {
                const likeButton = document.querySelector(`[data-like-btn="${contentId}"]`);
                const likeCount = document.querySelector(`[data-like-count="${contentId}"]`);
                
                if (likeButton) {
                    const icon = likeButton.querySelector('i');
                    if (data.liked) {
                        icon.className = 'fas fa-heart text-red-500';
                        likeButton.classList.add('text-red-500');
                    } else {
                        icon.className = 'far fa-heart';
                        likeButton.classList.remove('text-red-500');
                    }
                }
                
                if (likeCount) {
                    likeCount.textContent = data.likes_count;
                }
            }
        } catch (error) {
            console.error('Error toggling like:', error);
        }
    };

    window.toggleBookmark = async function(contentId) {
        try {
            const response = await fetch(`/content/${contentId}/bookmark`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
            });

            const data = await response.json();
            
            if (response.ok) {
                const bookmarkButton = document.querySelector(`[data-bookmark-btn="${contentId}"]`);
                
                if (bookmarkButton) {
                    const icon = bookmarkButton.querySelector('i');
                    if (data.bookmarked) {
                        icon.className = 'fas fa-bookmark text-yellow-500';
                        bookmarkButton.classList.add('text-yellow-500');
                    } else {
                        icon.className = 'far fa-bookmark';
                        bookmarkButton.classList.remove('text-yellow-500');
                    }
                }
            }
        } catch (error) {
            console.error('Error toggling bookmark:', error);
        }
    };

    window.shareContent = async function(contentId) {
        const url = window.location.href;
        const title = document.title;

        if (navigator.share) {
            try {
                await navigator.share({
                    title: title,
                    url: url
                });
                
                // Track share
                fetch(`/content/${contentId}/share`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                });
            } catch (error) {
                console.log('Error sharing:', error);
            }
        } else {
            // Fallback to clipboard
            try {
                await navigator.clipboard.writeText(url);
                showNotification('Link copied to clipboard!', 'success');
                
                // Track share
                fetch(`/content/${contentId}/share`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                });
            } catch (error) {
                console.error('Error copying to clipboard:', error);
            }
        }
    };

    // Notification system
    window.showNotification = function(message, type = 'info', duration = 3000) {
        const notification = document.createElement('div');
        notification.className = `fixed top-20 right-4 z-50 max-w-sm w-full p-4 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300`;
        
        const colors = {
            success: 'bg-green-100 border border-green-400 text-green-700',
            error: 'bg-red-100 border border-red-400 text-red-700',
            warning: 'bg-yellow-100 border border-yellow-400 text-yellow-700',
            info: 'bg-blue-100 border border-blue-400 text-blue-700'
        };
        
        const icons = {
            success: 'fas fa-check-circle',
            error: 'fas fa-exclamation-circle',
            warning: 'fas fa-exclamation-triangle',
            info: 'fas fa-info-circle'
        };
        
        notification.className += ` ${colors[type]}`;
        
        notification.innerHTML = `
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="${icons[type]} mr-2"></i>
                    <span>${message}</span>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 hover:opacity-70">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        // Auto remove
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, duration);
    };

    // Progressive Web App support
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js')
            .then(registration => {
                console.log('SW registered:', registration);
            })
            .catch(error => {
                console.log('SW registration failed:', error);
            });
    }

    // Dark mode persistence
    const darkModeToggle = document.querySelector('[data-dark-mode-toggle]');
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', () => {
            const isDark = document.documentElement.classList.contains('dark');
            localStorage.setItem('darkMode', !isDark);
        });
    }

    // Search functionality enhancement
    const searchInputs = document.querySelectorAll('input[type="search"]');
    searchInputs.forEach(input => {
        let searchTimeout;
        input.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                // Trigger search after user stops typing
                const event = new Event('search');
                this.dispatchEvent(event);
            }, 500);
        });
    });

    // Infinite scroll for content lists
    const infiniteScrollContainers = document.querySelectorAll('[data-infinite-scroll]');
    infiniteScrollContainers.forEach(container => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const url = container.dataset.nextPageUrl;
                    if (url) {
                        loadMoreContent(container, url);
                    }
                }
            });
        }, {
            threshold: 0.1
        });

        const sentinel = container.querySelector('.infinite-scroll-sentinel');
        if (sentinel) {
            observer.observe(sentinel);
        }
    });

    async function loadMoreContent(container, url) {
        try {
            const response = await fetch(url);
            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            const newContent = doc.querySelector('[data-infinite-scroll]');
            if (newContent) {
                const items = newContent.children;
                Array.from(items).forEach(item => {
                    if (!item.classList.contains('infinite-scroll-sentinel')) {
                        container.insertBefore(item, container.querySelector('.infinite-scroll-sentinel'));
                    }
                });
                
                // Update next page URL
                const nextUrl = newContent.dataset.nextPageUrl;
                container.dataset.nextPageUrl = nextUrl;
            }
        } catch (error) {
            console.error('Error loading more content:', error);
        }
    }
});

// Utility functions
window.formatNumber = function(num) {
    if (num >= 1000000) {
        return (num / 1000000).toFixed(1) + 'M';
    } else if (num >= 1000) {
        return (num / 1000).toFixed(1) + 'K';
    }
    return num.toString();
};

window.timeAgo = function(date) {
    const now = new Date();
    const diffInSeconds = Math.floor((now - new Date(date)) / 1000);
    
    if (diffInSeconds < 60) return 'baru saja';
    if (diffInSeconds < 3600) return `${Math.floor(diffInSeconds / 60)} menit lalu`;
    if (diffInSeconds < 86400) return `${Math.floor(diffInSeconds / 3600)} jam lalu`;
    if (diffInSeconds < 2592000) return `${Math.floor(diffInSeconds / 86400)} hari lalu`;
    if (diffInSeconds < 31536000) return `${Math.floor(diffInSeconds / 2592000)} bulan lalu`;
    return `${Math.floor(diffInSeconds / 31536000)} tahun lalu`;
};

// Error boundary for async functions
window.asyncErrorBoundary = function(asyncFn) {
    return async function(...args) {
        try {
            return await asyncFn.apply(this, args);
        } catch (error) {
            console.error('Async error:', error);
            showNotification('Terjadi kesalahan. Silakan coba lagi.', 'error');
            throw error;
        }
    };
};