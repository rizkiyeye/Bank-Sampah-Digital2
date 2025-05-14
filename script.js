document.addEventListener('DOMContentLoaded', function() {
    // Mobile Navigation Toggle
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');
    
    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('active');
        navLinks.classList.toggle('active');
    });
    
    // Close mobile menu when clicking on a nav link
    document.querySelectorAll('.nav-links li a').forEach(link => {
        link.addEventListener('click', () => {
            hamburger.classList.remove('active');
            navLinks.classList.remove('active');
        });
    });
    
    // Smooth scrolling for all anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const headerHeight = document.querySelector('header').offsetHeight;
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset;
                
                window.scrollTo({
                    top: targetPosition - headerHeight,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Login and Registration Modal Functionality
    const loginBtn = document.getElementById('loginBtn');
    const loginBtnMobile = document.getElementById('loginBtnMobile');
    const registerBtn = document.getElementById('registerBtn');
    const registerBtnMobile = document.getElementById('registerBtnMobile');
    const registerBtnHero = document.getElementById('registerBtnHero');
    
    // Create modal container if it doesn't exist
    let modalContainer = document.querySelector('.modal-container');
    if (!modalContainer) {
        modalContainer = document.createElement('div');
        modalContainer.className = 'modal-container';
        document.body.appendChild(modalContainer);
    }
    
    // Function to create and show modal
    function showModal(type) {
        // Clear existing modal
        modalContainer.innerHTML = '';
        
        // Create modal content
        const modal = document.createElement('div');
        modal.className = 'modal';
        
        // Modal header
        const modalHeader = document.createElement('div');
        modalHeader.className = 'modal-header';
        
        const modalTitle = document.createElement('h2');
        modalTitle.textContent = type === 'login' ? 'Masuk ke Akun' : 'Daftar Akun Baru';
        
        const closeBtn = document.createElement('span');
        closeBtn.className = 'close-btn';
        closeBtn.innerHTML = '&times;';
        closeBtn.addEventListener('click', () => {
            modalContainer.classList.remove('active');
        });
        
        modalHeader.appendChild(modalTitle);
        modalHeader.appendChild(closeBtn);
        
        // Modal body - Form
        const form = document.createElement('form');
        form.className = 'auth-form';
        
        // Email input
        const emailGroup = document.createElement('div');
        emailGroup.className = 'form-group';
        
        const emailLabel = document.createElement('label');
        emailLabel.setAttribute('for', 'email');
        emailLabel.textContent = 'Email';
        
        const emailInput = document.createElement('input');
        emailInput.type = 'email';
        emailInput.id = 'email';
        emailInput.placeholder = 'Masukkan email Anda';
        emailInput.required = true;
        
        emailGroup.appendChild(emailLabel);
        emailGroup.appendChild(emailInput);
        
        // Password input
        const passwordGroup = document.createElement('div');
        passwordGroup.className = 'form-group';
        
        const passwordLabel = document.createElement('label');
        passwordLabel.setAttribute('for', 'password');
        passwordLabel.textContent = 'Password';
        
        const passwordInput = document.createElement('input');
        passwordInput.type = 'password';
        passwordInput.id = 'password';
        passwordInput.placeholder = 'Masukkan password Anda';
        passwordInput.required = true;
        
        passwordGroup.appendChild(passwordLabel);
        passwordGroup.appendChild(passwordInput);
        
        // Additional fields for registration
        if (type === 'register') {
            // Name input
            const nameGroup = document.createElement('div');
            nameGroup.className = 'form-group';
            
            const nameLabel = document.createElement('label');
            nameLabel.setAttribute('for', 'name');
            nameLabel.textContent = 'Nama Lengkap';
            
            const nameInput = document.createElement('input');
            nameInput.type = 'text';
            nameInput.id = 'name';
            nameInput.placeholder = 'Masukkan nama lengkap Anda';
            nameInput.required = true;
            
            nameGroup.appendChild(nameLabel);
            nameGroup.appendChild(nameInput);
            
            // Phone input
            const phoneGroup = document.createElement('div');
            phoneGroup.className = 'form-group';
            
            const phoneLabel = document.createElement('label');
            phoneLabel.setAttribute('for', 'phone');
            phoneLabel.textContent = 'Nomor Telepon';
            
            const phoneInput = document.createElement('input');
            phoneInput.type = 'tel';
            phoneInput.id = 'phone';
            phoneInput.placeholder = 'Masukkan nomor telepon Anda';
            phoneInput.required = true;
            
            phoneGroup.appendChild(phoneLabel);
            phoneGroup.appendChild(phoneInput);
            
            // Add to form in the right order
            form.appendChild(nameGroup);
            form.appendChild(emailGroup);
            form.appendChild(phoneGroup);
            form.appendChild(passwordGroup);
        } else {
            // Login form just has email and password
            form.appendChild(emailGroup);
            form.appendChild(passwordGroup);
            
            // Add forgot password link for login
            const forgotPassword = document.createElement('div');
            forgotPassword.className = 'forgot-password';
            
            const forgotLink = document.createElement('a');
            forgotLink.href = '#';
            forgotLink.textContent = 'Lupa password?';
            
            forgotPassword.appendChild(forgotLink);
            form.appendChild(forgotPassword);
        }
        
        // Submit button
        const submitBtn = document.createElement('button');
        submitBtn.type = 'submit';
        submitBtn.className = 'btn';
        submitBtn.textContent = type === 'login' ? 'Masuk' : 'Daftar';
        
        form.appendChild(submitBtn);
        
        // Toggle between login and register
        const toggleAuth = document.createElement('div');
        toggleAuth.className = 'toggle-auth';
        
        const toggleText = document.createElement('p');
        if (type === 'login') {
            toggleText.innerHTML = 'Belum punya akun? <a href="#" class="toggle-link">Daftar</a>';
        } else {
            toggleText.innerHTML = 'Sudah punya akun? <a href="#" class="toggle-link">Masuk</a>';
        }
        
        toggleAuth.appendChild(toggleText);
        
        // Add event listener for toggle
        toggleAuth.querySelector('.toggle-link').addEventListener('click', (e) => {
            e.preventDefault();
            showModal(type === 'login' ? 'register' : 'login');
        });
        
        // Add form submission event
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            alert(`Form ${type} berhasil dikirim! Ini hanya contoh UI, tidak ada proses backend yang terjadi.`);
            modalContainer.classList.remove('active');
        });
        
        // Assemble and show modal
        modal.appendChild(modalHeader);
        modal.appendChild(form);
        modal.appendChild(toggleAuth);
        
        modalContainer.appendChild(modal);
        modalContainer.classList.add('active');
    }
    
    // Add event listeners to buttons
    if (loginBtn) loginBtn.addEventListener('click', () => showModal('login'));
    if (loginBtnMobile) loginBtnMobile.addEventListener('click', () => showModal('login'));
    if (registerBtn) registerBtn.addEventListener('click', () => showModal('register'));
    if (registerBtnMobile) registerBtnMobile.addEventListener('click', () => showModal('register'));
    if (registerBtnHero) registerBtnHero.addEventListener('click', () => showModal('register'));
    
    // Close modal when clicking outside of it
    window.addEventListener('click', (e) => {
        if (e.target === modalContainer) {
            modalContainer.classList.remove('active');
        }
    });
    
    // Add styles for modal if not already in CSS
    const modalStyles = `
        .modal-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1001;
            justify-content: center;
            align-items: center;
        }
        
        .modal-container.active {
            display: flex;
        }
        
        .modal {
            background-color: white;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            animation: modalFadeIn 0.3s;
        }
        
        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .modal-header h2 {
            margin: 0;
            color: #2ecc71;
        }
        
        .close-btn {
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            color: #777;
            transition: color 0.3s;
        }
        
        .close-btn:hover {
            color: #333;
        }
        
        .auth-form .form-group {
            margin-bottom: 20px;
        }
        
        .auth-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .auth-form input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        .auth-form input:focus {
            outline: none;
            border-color: #2ecc71;
        }
        
        .auth-form .btn {
            width: 100%;
            margin-top: 10px;
        }
        
        .forgot-password {
            text-align: right;
            margin-bottom: 20px;
        }
        
        .forgot-password a {
            color: #2ecc71;
            font-size: 14px;
        }
        
        .toggle-auth {
            text-align: center;
            margin-top: 20px;
        }
        
        .toggle-auth a {
            color: #2ecc71;
            font-weight: 600;
        }
    `;
    
    // Add modal styles to head
    const styleElement = document.createElement('style');
    styleElement.textContent = modalStyles;
    document.head.appendChild(styleElement);
    
    // Animation for features on scroll
    const featureSections = document.querySelectorAll('.feature-card, .step, .category-card');
    
    function checkScroll() {
        featureSections.forEach(section => {
            const sectionTop = section.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (sectionTop < windowHeight * 0.85) {
                section.classList.add('show');
            }
        });
    }
    
    // Add animation styles
    const animationStyles = `
        .feature-card, .step, .category-card {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        
        .feature-card.show, .step.show, .category-card.show {
            opacity: 1;
            transform: translateY(0);
        }
    `;
    
    const animationStyleElement = document.createElement('style');
    animationStyleElement.textContent = animationStyles;
    document.head.appendChild(animationStyleElement);
    
    // Check for animations on initial load
    checkScroll();
    
    // Check for animations on scroll
    window.addEventListener('scroll', checkScroll);
    
    // Header scroll effect
    const header = document.querySelector('header');
    let lastScrollPosition = 0;
    
    function handleScroll() {
        const currentScrollPosition = window.pageYOffset;
        
        if (currentScrollPosition > lastScrollPosition && currentScrollPosition > 100) {
            // Scrolling down
            header.style.transform = 'translateY(-100%)';
        } else {
            // Scrolling up
            header.style.transform = 'translateY(0)';
        }
        
        lastScrollPosition = currentScrollPosition;
    }
    
    // Add header transition style
    const headerStyle = `
        header {
            transition: transform 0.3s ease;
        }
    `;
    
    const headerStyleElement = document.createElement('style');
    headerStyleElement.textContent = headerStyle;
    document.head.appendChild(headerStyleElement);
    
    // Activate header scroll effect
    window.addEventListener('scroll', handleScroll);
    
    // Contact Form Submission
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Collect form data
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;
            
            // Here you would normally send this data to a server
            // For demo purposes, we'll just show an alert
            
            alert(`Terima kasih ${name}! Pesan Anda telah diterima. Kami akan menghubungi Anda segera.`);
            
            // Reset form
            contactForm.reset();
        });
    }
    
    // Add map to contact section
    // Note: In a real implementation, you would use an actual map service like Google Maps
    function createMapPlaceholder() {
        const contactInfo = document.querySelector('.contact-info');
        if (contactInfo) {
            const mapContainer = document.createElement('div');
            mapContainer.className = 'map-container';
            mapContainer.innerHTML = `
                <h3>Lokasi Kami</h3>
                <div class="map-placeholder">
                    <img src="/api/placeholder/400/200" alt="Maps Location">
                    <p>Tampilan peta sedang dimuat...</p>
                </div>
            `;
            
            contactInfo.appendChild(mapContainer);
            
            // Add map placeholder styles
            const mapStyles = `
                .map-container {
                    margin-top: 30px;
                }
                
                .map-container h3 {
                    margin-bottom: 15px;
                    color: #2ecc71;
                }
                
                .map-placeholder {
                    width: 100%;
                    height: 200px;
                    background-color: #f0f0f0;
                    border-radius: 10px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    overflow: hidden;
                }
                
                .map-placeholder img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
                
                .map-placeholder p {
                    position: absolute;
                    background: rgba(0,0,0,0.6);
                    color: white;
                    padding: 5px 10px;
                    border-radius: 5px;
                }
            `;
            
            const mapStyleElement = document.createElement('style');
            mapStyleElement.textContent = mapStyles;
            document.head.appendChild(mapStyleElement);
        }
    }
    
    // Call map creation function
    createMapPlaceholder();
});