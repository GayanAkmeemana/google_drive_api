# Google Drive API using with PHP #
<dl>
  <dt>Demo</dt><dd><a href="https://gatech.lk/sliitssoauth/">https://gatech.lk/sliitssoauth/</a></dd>
</dl>

This document will provide basic information to use this repository.

## Setup Google Project
1. If you already have google account login to it or create a new Google accuont. [sign up](https://www.google.com/accounts).
2. Then login to the [Google Developers Console](https://console.developers.google.com/) and create a Google API Project.
3. Generate Client ID and Secret Key

## Run the project
Download the project and copy in the the server folder. Then set the following settings in the config.php in the config folder.

```php
// Google API configuration 
define('GOOGLE_CLIENT_ID', '< YOUR APP CLIENT ID >'); 
define('GOOGLE_CLIENT_SECRET', '< YOUR APP SECRET KEY >'); 
define('GOOGLE_OAUTH_SCOPE', 'https://www.googleapis.com/auth/drive'); 
define('REDIRECT_URI', '< YOUR REDIRECT URI >'); 
```

Then you can run the project.
