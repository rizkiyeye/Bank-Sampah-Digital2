document.addEventListener("DOMContentLoaded", function () {
  // Mobile Navigation Toggle
  const hamburger = document.querySelector(".hamburger");
  const navLinks = document.querySelector(".nav-links");

  hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    navLinks.classList.toggle("active");
  });

  // Close mobile menu when clicking on a nav link
  document.querySelectorAll(".nav-links li a").forEach((link) => {
    link.addEventListener("click", () => {
      hamburger.classList.remove("active");
      navLinks.classList.remove("active");
    });
  });

  // Smooth scrolling for all anchor links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();

      const targetId = this.getAttribute("href");
      if (targetId === "#") return;

      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        const headerHeight = document.querySelector("header").offsetHeight;
        const targetPosition =
          targetElement.getBoundingClientRect().top + window.pageYOffset;

        window.scrollTo({
          top: targetPosition - headerHeight,
          behavior: "smooth",
        });
      }
    });
  });

  // Enhanced Notification System
  function showNotification(message, type = "success", duration = 5000) {
    // Remove existing notifications
    const existingNotification = document.querySelector(".notification");
    if (existingNotification) {
      existingNotification.remove();
    }

    // Create notification element
    const notification = document.createElement("div");
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
            <div class="notification-content">
                <span class="notification-icon">${
                  type === "success" ? "✅" : type === "error" ? "❌" : "ℹ️"
                }</span>
                <span class="notification-message">${message}</span>
                <button class="notification-close">&times;</button>
            </div>
        `;

    // Add to body
    document.body.appendChild(notification);

    // Show notification with animation
    setTimeout(() => notification.classList.add("show"), 100);

    // Auto remove after duration
    const timeoutId = setTimeout(() => {
      hideNotification(notification);
    }, duration);

    // Close button functionality
    notification
      .querySelector(".notification-close")
      .addEventListener("click", () => {
        clearTimeout(timeoutId);
        hideNotification(notification);
      });

    return notification;
  }

  function hideNotification(notification) {
    notification.classList.add("hide");
    setTimeout(() => {
      if (notification.parentNode) {
        notification.parentNode.removeChild(notification);
      }
    }, 300);
  }

  // Loading spinner function
  function showLoading(button) {
    const originalText = button.textContent;
    button.disabled = true;
    button.innerHTML = '<span class="loading-spinner"></span> Memproses...';
    return originalText;
  }

  function hideLoading(button, originalText) {
    button.disabled = false;
    button.innerHTML = originalText;
  }

  // API Communication Functions
  async function sendAuthRequest(endpoint, data) {
    try {
      const response = await fetch(endpoint, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-Requested-With": "XMLHttpRequest",
        },
        body: JSON.stringify(data),
      });

      const result = await response.json();

      if (!response.ok) {
        throw new Error(result.message || "Terjadi kesalahan pada server");
      }

      return result;
    } catch (error) {
      if (error.name === "TypeError" && error.message.includes("fetch")) {
        throw new Error(
          "Tidak dapat terhubung ke server. Periksa koneksi internet Anda."
        );
      }
      throw error;
    }
  }

  // Login and Registration Modal Functionality
  const loginBtn = document.getElementById("loginBtn");
  const loginBtnMobile = document.getElementById("loginBtnMobile");
  const registerBtn = document.getElementById("registerBtn");
  const registerBtnMobile = document.getElementById("registerBtnMobile");
  const registerBtnHero = document.getElementById("registerBtnHero");

  // Create modal container if it doesn't exist
  let modalContainer = document.querySelector(".modal-container");
  if (!modalContainer) {
    modalContainer = document.createElement("div");
    modalContainer.className = "modal-container";
    document.body.appendChild(modalContainer);
  }

  // Enhanced validation functions
  function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  function validatePhone(phone) {
    const phoneRegex = /^(\+62|62|0)[0-9]{9,13}$/;
    return phoneRegex.test(phone.replace(/\s+/g, ""));
  }

  function validatePassword(password) {
    return password.length >= 6;
  }

  function validateForm(formData, type) {
    const errors = [];

    if (!validateEmail(formData.email)) {
      errors.push("Format email tidak valid");
    }

    if (!validatePassword(formData.password)) {
      errors.push("Password minimal 6 karakter");
    }

    if (type === "register") {
      if (!formData.name || formData.name.trim().length < 2) {
        errors.push("Nama lengkap minimal 2 karakter");
      }

      if (!validatePhone(formData.phone)) {
        errors.push("Format nomor telepon tidak valid");
      }
    }

    return errors;
  }

  // Function to create and show modal
  function showModal(type) {
    // Clear existing modal
    modalContainer.innerHTML = "";

    // Create modal content
    const modal = document.createElement("div");
    modal.className = "modal";

    // Modal header
    const modalHeader = document.createElement("div");
    modalHeader.className = "modal-header";

    const modalTitle = document.createElement("h2");
    modalTitle.textContent =
      type === "login" ? "Masuk ke Akun" : "Daftar Akun Baru";

    const closeBtn = document.createElement("span");
    closeBtn.className = "close-btn";
    closeBtn.innerHTML = "&times;";
    closeBtn.addEventListener("click", () => {
      modalContainer.classList.remove("active");
    });

    modalHeader.appendChild(modalTitle);
    modalHeader.appendChild(closeBtn);

    // Modal body - Form
    const form = document.createElement("form");
    form.className = "auth-form";

    // Additional fields for registration
    if (type === "register") {
      // Name input
      const nameGroup = document.createElement("div");
      nameGroup.className = "form-group";

      const nameLabel = document.createElement("label");
      nameLabel.setAttribute("for", "name");
      nameLabel.textContent = "Nama Lengkap";

      const nameInput = document.createElement("input");
      nameInput.type = "text";
      nameInput.id = "name";
      nameInput.name = "name";
      nameInput.placeholder = "Masukkan nama lengkap Anda";
      nameInput.required = true;

      nameGroup.appendChild(nameLabel);
      nameGroup.appendChild(nameInput);
      form.appendChild(nameGroup);
    }

    // Email input
    const emailGroup = document.createElement("div");
    emailGroup.className = "form-group";

    const emailLabel = document.createElement("label");
    emailLabel.setAttribute("for", "email");
    emailLabel.textContent = "Email";

    const emailInput = document.createElement("input");
    emailInput.type = "email";
    emailInput.id = "email";
    emailInput.name = "email";
    emailInput.placeholder = "Masukkan email Anda";
    emailInput.required = true;

    emailGroup.appendChild(emailLabel);
    emailGroup.appendChild(emailInput);
    form.appendChild(emailGroup);

    if (type === "register") {
      // Phone input
      const phoneGroup = document.createElement("div");
      phoneGroup.className = "form-group";

      const phoneLabel = document.createElement("label");
      phoneLabel.setAttribute("for", "phone");
      phoneLabel.textContent = "Nomor Telepon";

      const phoneInput = document.createElement("input");
      phoneInput.type = "tel";
      phoneInput.id = "phone";
      phoneInput.name = "phone";
      phoneInput.placeholder = "Masukkan nomor telepon Anda";
      phoneInput.required = true;

      phoneGroup.appendChild(phoneLabel);
      phoneGroup.appendChild(phoneInput);
      form.appendChild(phoneGroup); 
    }

    // Password input
    const passwordGroup = document.createElement("div");
    passwordGroup.className = "form-group";

    const passwordLabel = document.createElement("label");
    passwordLabel.setAttribute("for", "password");
    passwordLabel.textContent = "Password";

    const passwordInputContainer = document.createElement("div");
    passwordInputContainer.className = "password-input-container";

    const passwordInput = document.createElement("input");
    passwordInput.type = "password";
    passwordInput.id = "password";
    passwordInput.name = "password";
    passwordInput.placeholder = "Masukkan password Anda";
    passwordInput.required = true;

    const togglePassword = document.createElement("button");
    togglePassword.type = "button";
    togglePassword.className = "toggle-password";
    togglePassword.innerHTML = "👁️";
    togglePassword.addEventListener("click", () => {
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        togglePassword.innerHTML = "🙈";
      } else {
        passwordInput.type = "password";
        togglePassword.innerHTML = "👁️";
      }
    });

    passwordInputContainer.appendChild(passwordInput);
    passwordInputContainer.appendChild(togglePassword);
    passwordGroup.appendChild(passwordLabel);
    passwordGroup.appendChild(passwordInputContainer);
    form.appendChild(passwordGroup);

    // Add forgot password link for login
    if (type === "login") {
      const forgotPassword = document.createElement("div");
      forgotPassword.className = "forgot-password";

      const forgotLink = document.createElement("a");
      forgotLink.href = "#";
      forgotLink.textContent = "Lupa password?";
      forgotLink.addEventListener("click", (e) => {
        e.preventDefault();
        showNotification("Fitur lupa password akan segera tersedia", "info");
      });

      forgotPassword.appendChild(forgotLink);
      form.appendChild(forgotPassword);
    }

    // Submit button
    const submitBtn = document.createElement("button");
    submitBtn.type = "submit";
    submitBtn.className = "btn";
    submitBtn.textContent = type === "login" ? "Masuk" : "Daftar";

    form.appendChild(submitBtn);

    // Toggle between login and register
    const toggleAuth = document.createElement("div");
    toggleAuth.className = "toggle-auth";

    const toggleText = document.createElement("p");
    if (type === "login") {
      toggleText.innerHTML =
        'Belum punya akun? <a href="#" class="toggle-link">Daftar</a>';
    } else {
      toggleText.innerHTML =
        'Sudah punya akun? <a href="#" class="toggle-link">Masuk</a>';
    }

    toggleAuth.appendChild(toggleText);

    // Add event listener for toggle
    toggleAuth.querySelector(".toggle-link").addEventListener("click", (e) => {
      e.preventDefault();
      showModal(type === "login" ? "register" : "login");
    });

    // Enhanced form submission with backend integration
    form.addEventListener("submit", async (e) => {
      e.preventDefault();

      // Collect form data
      const formData = new FormData(form);
      const data = Object.fromEntries(formData.entries());

      // Validate form
      const validationErrors = validateForm(data, type);
      if (validationErrors.length > 0) {
        showNotification(validationErrors.join("<br>"), "error");
        return;
      }

      // Show loading state
      const originalText = showLoading(submitBtn);

      try {
        // Determine endpoint based on type
        const endpoint =
          type === "login" ? "api/login.php" : "api/register.php";

        // Send request to backend
        const result = await sendAuthRequest(endpoint, data);

        // Handle successful response
        if (result.success) {
          showNotification(
            result.message ||
              `${type === "login" ? "Login" : "Registrasi"} berhasil!`,
            "success"
          );

          // Store user data if login successful
          if (type === "login" && result.user) {
            sessionStorage.setItem("user", JSON.stringify(result.user));

            // Update UI to show logged in state
            updateUIForLoggedInUser(result.user);
          }

          // Close modal
          modalContainer.classList.remove("active");

          // Redirect or refresh if needed
          if (result.redirect) {
            setTimeout(() => {
              window.location.href = result.redirect;
            }, 1500);
          }
        } else {
          showNotification(result.message || "Terjadi kesalahan", "error");
        }
      } catch (error) {
        console.error("Auth error:", error);
        showNotification(
          error.message || "Terjadi kesalahan pada sistem",
          "error"
        );
      } finally {
        hideLoading(submitBtn, originalText);
      }
    });

    // Assemble and show modal
    modal.appendChild(modalHeader);
    modal.appendChild(form);
    modal.appendChild(toggleAuth);

    modalContainer.appendChild(modal);
    modalContainer.classList.add("active");

    // Focus on first input
    setTimeout(() => {
      const firstInput = form.querySelector("input");
      if (firstInput) firstInput.focus();
    }, 300);
  }

  // Function to update UI for logged in user
  function updateUIForLoggedInUser(user) {
    // Update navigation buttons
    const authButtons = document.querySelectorAll(
      "#loginBtn, #registerBtn, #loginBtnMobile, #registerBtnMobile"
    );
    authButtons.forEach((btn) => {
      if (btn) {
        btn.style.display = "none";
      }
    });

    // Add user menu or logout button
    const nav = document.querySelector(".nav-links");
    if (nav && !document.querySelector(".user-menu")) {
      const userMenu = document.createElement("li");
      userMenu.className = "user-menu";
      userMenu.innerHTML = `
                <span class="user-greeting">Halo, ${user.name}</span>
                <button id="logoutBtn" class="btn btn-outline">Logout</button>
            `;
      nav.appendChild(userMenu);

      // Add logout functionality
      document.getElementById("logoutBtn").addEventListener("click", logout);
    }
  }

  // Logout function
  function logout() {
    sessionStorage.removeItem("user");
    showNotification("Anda telah berhasil logout", "success");

    // Refresh page to reset UI
    setTimeout(() => {
      window.location.reload();
    }, 1500);
  }

  // Check if user is already logged in on page load
  function checkLoginStatus() {
    const userData = sessionStorage.getItem("user");
    if (userData) {
      try {
        const user = JSON.parse(userData);
        updateUIForLoggedInUser(user);
      } catch (error) {
        sessionStorage.removeItem("user");
      }
    }
  }

  // Add event listeners to buttons
  if (loginBtn) loginBtn.addEventListener("click", () => showModal("login"));
  if (loginBtnMobile)
    loginBtnMobile.addEventListener("click", () => showModal("login"));
  if (registerBtn)
    registerBtn.addEventListener("click", () => showModal("register"));
  if (registerBtnMobile)
    registerBtnMobile.addEventListener("click", () => showModal("register"));
  if (registerBtnHero)
    registerBtnHero.addEventListener("click", () => showModal("register"));

  // Close modal when clicking outside of it
  window.addEventListener("click", (e) => {
    if (e.target === modalContainer) {
      modalContainer.classList.remove("active");
    }
  });

  // Enhanced styles for modal and notifications
  const enhancedStyles = `
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
            max-height: 90vh;
            overflow-y: auto;
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
            box-sizing: border-box;
        }
        
        .auth-form input:focus {
            outline: none;
            border-color: #2ecc71;
        }
        
        .password-input-container {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .toggle-password {
            position: absolute;
            right: 10px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            z-index: 1;
        }
        
        .auth-form .btn {
            width: 100%;
            margin-top: 10px;
            padding: 12px;
            background-color: #2ecc71;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .auth-form .btn:hover:not(:disabled) {
            background-color: #27ae60;
        }
        
        .auth-form .btn:disabled {
            background-color: #95a5a6;
            cursor: not-allowed;
        }
        
        .loading-spinner {
            width: 12px;
            height: 12px;
            border: 2px solid #ffffff;
            border-top: 2px solid transparent;
            border-radius: 50%;
            display: inline-block;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .forgot-password {
            text-align: right;
            margin-bottom: 20px;
        }
        
        .forgot-password a {
            color: #2ecc71;
            font-size: 14px;
            text-decoration: none;
        }
        
        .forgot-password a:hover {
            text-decoration: underline;
        }
        
        .toggle-auth {
            text-align: center;
            margin-top: 20px;
        }
        
        .toggle-auth a {
            color: #2ecc71;
            font-weight: 600;
            text-decoration: none;
        }
        
        .toggle-auth a:hover {
            text-decoration: underline;
        }
        
        /* Notification Styles */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            max-width: 400px;
            z-index: 1002;
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .notification.show {
            transform: translateX(0);
            opacity: 1;
        }
        
        .notification.hide {
            transform: translateX(100%);
            opacity: 0;
        }
        
        .notification-content {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            background: white;
            border-left: 4px solid;
        }
        
        .notification-success .notification-content {
            border-left-color: #2ecc71;
            background: #f8fff9;
        }
        
        .notification-error .notification-content {
            border-left-color: #e74c3c;
            background: #fff8f8;
        }
        
        .notification-info .notification-content {
            border-left-color: #3498db;
            background: #f8fbff;
        }
        
        .notification-icon {
            font-size: 18px;
            margin-right: 12px;
        }
        
        .notification-message {
            flex: 1;
            font-size: 14px;
            line-height: 1.4;
        }
        
        .notification-close {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: #999;
            margin-left: 10px;
            padding: 0;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .notification-close:hover {
            color: #666;
        }
        
        /* User Menu Styles */
        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-greeting {
            color: #2ecc71;
            font-weight: 500;
        }
        
        .btn-outline {
            background: transparent;
            border: 2px solid #2ecc71;
            color: #2ecc71;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .btn-outline:hover {
            background: #2ecc71;
            color: white;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .modal {
                width: 95%;
                padding: 20px;
                margin: 10px;
            }
            
            .notification {
                top: 10px;
                right: 10px;
                left: 10px;
                max-width: none;
            }
            
            .user-menu {
                flex-direction: column;
                gap: 10px;
            }
        }
    `;

  // Add enhanced styles to head
  const styleElement = document.createElement("style");
  styleElement.textContent = enhancedStyles;
  document.head.appendChild(styleElement);

  // Check login status on page load
  checkLoginStatus();

  // Animation for features on scroll
  const featureSections = document.querySelectorAll(
    ".feature-card, .step, .category-card"
  );

  function checkScroll() {
    featureSections.forEach((section) => {
      const sectionTop = section.getBoundingClientRect().top;
      const windowHeight = window.innerHeight;

      if (sectionTop < windowHeight * 0.85) {
        section.classList.add("show");
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

  const animationStyleElement = document.createElement("style");
  animationStyleElement.textContent = animationStyles;
  document.head.appendChild(animationStyleElement);

  // Check for animations on initial load
  checkScroll();

  // Check for animations on scroll
  window.addEventListener("scroll", checkScroll);

  // Header scroll effect
  const header = document.querySelector("header");
  let lastScrollPosition = 0;

  function handleScroll() {
    const currentScrollPosition = window.pageYOffset;

    if (
      currentScrollPosition > lastScrollPosition &&
      currentScrollPosition > 100
    ) {
      // Scrolling down
      header.style.transform = "translateY(-100%)";
    } else {
      // Scrolling up
      header.style.transform = "translateY(0)";
    }

    lastScrollPosition = currentScrollPosition;
  }

  // Add header transition style
  const headerStyle = `
        header {
            transition: transform 0.3s ease;
        }
    `;

  const headerStyleElement = document.createElement("style");
  headerStyleElement.textContent = headerStyle;
  document.head.appendChild(headerStyleElement);

  // Activate header scroll effect
  window.addEventListener("scroll", handleScroll);

  // Contact Form Submission
  const contactForm = document.querySelector(".contact-form");
  if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
      e.preventDefault();

      // Collect form data
      const name = document.getElementById("name").value;
      const email = document.getElementById("email").value;
      const phone = document.getElementById("phone").value;
      const subject = document.getElementById("subject").value;
      const message = document.getElementById("message").value;

      // Show success notification
      showNotification(
        `Terima kasih ${name}! Pesan Anda telah diterima. Kami akan menghubungi Anda segera.`,
        "success"
      );

      // Reset form
      contactForm.reset();
    });
  }

  // Add map to contact section
  function createMapPlaceholder() {
    const contactInfo = document.querySelector(".contact-info");
    if (contactInfo) {
      const mapContainer = document.createElement("div");
      mapContainer.className = "map-container";
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

      const mapStyleElement = document.createElement("style");
      mapStyleElement.textContent = mapStyles;
      document.head.appendChild(mapStyleElement);
    }
  }

  // Call map creation function
  createMapPlaceholder();
});
