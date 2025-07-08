# Google OAuth Setup Guide

## Prerequisites
- Laravel Socialite package is already installed
- Google OAuth routes are configured
- Database migration with `google_id` field is ready

## Step 1: Create Google OAuth Credentials

1. Go to the [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select an existing one
3. Enable the Google+ API (or Google Identity API)
4. Go to "Credentials" in the left sidebar
5. Click "Create Credentials" → "OAuth 2.0 Client IDs"
6. Choose "Web application" as the application type
7. Add the following authorized redirect URIs:
   - `http://localhost/auth/google/callback` (for local development)
   - `https://yourdomain.com/auth/google/callback` (for production)

## Step 2: Configure Environment Variables

Add your Google OAuth credentials to your `.env` file:

```env
GOOGLE_CLIENT_ID=your_google_client_id_here
GOOGLE_CLIENT_SECRET=your_google_client_secret_here
GOOGLE_REDIRECT_URI=http://localhost/auth/google/callback
```

## Step 3: Test the Integration

1. Start your Laravel development server:
   ```bash
   php artisan serve
   ```

2. Visit your login page at `http://localhost:8000/signin`

3. Click the "Google" button to test the OAuth flow

## Features Implemented

- ✅ Google OAuth authentication
- ✅ Automatic user creation for new Google users
- ✅ Linking existing accounts with Google ID
- ✅ Email verification for Google users
- ✅ Secure password generation for Google users
- ✅ Error handling for OAuth failures

## Routes Added

- `GET /auth/google` - Redirects to Google OAuth
- `GET /auth/google/callback` - Handles Google OAuth callback

## Files Modified/Created

- `app/Http/Controllers/GoogleAuthController.php` - New controller
- `config/services.php` - Added Google OAuth configuration
- `routes/web.php` - Added Google OAuth routes
- `resources/views/components/google-button.blade.php` - Updated to use OAuth
- `.env` - Added Google OAuth environment variables

## Security Notes

- Google users get a random password generated automatically
- Email verification is automatically set for Google users
- Existing users can link their accounts with Google
- All OAuth errors are handled gracefully 