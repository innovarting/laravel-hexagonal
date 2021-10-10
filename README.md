# Laravel Hexagonal

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

Laravel package that allows modifying the folder structure proposed by Laravel in its initial installation by a
structure based on **Hexagonal Architecture**.

### Install

```shell
composer require innovartingsas/laravel-hexagonal --dev
```

### Implementation

In the root project execute artisan command

```shell
php artisan hexagonal:install --folder={NAME_FOLDER} --app-namespace={APP_NAMESPACE}
```

Or use the short form

```shell
php artisan hexagonal:install -f {NAME_FOLDER} -a {APP_NAMESPACE}
```

The namespace is automatically added to the `psr-4` key of the compose.json file.

All files and folders found in the app folder will be moved to the Infrastructure folder found inside the folder defined in the `--folder` option of the package installation command.

---

### File structure created by the package

- App Folder Name
    - Application
    - Domain
        - Entities
            - Traits
                - AddProps.php
                - DeleteProps.php
                - Serializable.php
            - BaseEntity.php
            - EntityId.php
    - Infrastructure
        - Console
        - Exceptions
        - Http
        - Models
        - Providers
### Todo List

- [ ] Add CommandBus Contract
- [ ] Add Command and Handler Interface for UseCases
- [ ] Add custom Container Class
- [ ] Add binding for a CommandBus and Container Class
- [ ] Add Contracts folder inside Domain folder
- [ ] Add Repositories foder inside Domain folder



[ico-version]: https://img.shields.io/packagist/v/innovartingsas/laravel-hexagonal.svg?style=flat-square

[link-downloads]: https://packagist.org/packages/innovartingsas/laravel-hexagonal

[ico-downloads]: https://img.shields.io/packagist/dt/innovartingsas/laravel-hexagonal.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/innovartingsas/laravel-hexagonal
