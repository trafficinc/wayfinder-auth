# Wayfinder Auth

Authentication module package for Wayfinder.

This package is intended to be installed into a Wayfinder app and linked into the app's `Modules/` directory by the module installer command.

## Package identity

- Composer package: `wayfinder/auth`
- GitHub repo: `trafficinc/wayfinder-auth`

## Install into an app

From a Wayfinder app:

```bash
php wayfinder module:install auth
```

That should:

1. require `wayfinder/auth` with Composer
2. create a symlink at `Modules/Auth`

## Local development

This package keeps the module source at the package root so the linked `Modules/Auth` directory remains the module root that Wayfinder already expects.
