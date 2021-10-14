# Laravel Hexagonal

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE)

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

- [X] Add CommandBus Contract
- [X] Add Command and Handler Interface for UseCases
- [X] Add custom Container Class
- [X] Add binding for a CommandBus and Container Class
- [X] Add Contracts folder inside Domain folder
- [X] Add Repositories folder inside Domain folder
- [X] Add commands for the creation of entities, factories, repositories and use cases. 



[ico-version]: https://img.shields.io/packagist/v/innovartingsas/laravel-hexagonal.svg?style=flat-square
[ico-laravel-version]: https://img.shields.io/packagist/v/laravel/laravel.svg?style=flat-square
[link-laravel-downloads]: https://packagist.org/packages/laravel/laravel
[link-downloads]: https://packagist.org/packages/innovartingsas/laravel-hexagonal
[ico-downloads]: https://img.shields.io/packagist/dt/innovartingsas/laravel-hexagonal.svg?style=flat-square
[link-packagist]: https://packagist.org/packages/innovartingsas/laravel-hexagonal
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square


## License

The Laravel Hexagonal Package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
