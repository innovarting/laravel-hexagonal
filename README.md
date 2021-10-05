# Laravel Hexagonal

Laravel package that allows modifying the folder structure proposed by Laravel in its initial installation by a
structure based on **Hexagonal Architecture**.

### Estructura de archivos

- Core
    - Application
    - Domain
    - Infrastructure
        - Console
        - Exceptions
        - Http
        - Models
        - Providers

### Configurations

Add `HEXAGONAL_NAMESPACE` to `.env` file for custom Namespace, default value is `Hexagonal`
add `HEXAGONAL_NAMESPACE_FOLDER` to `.env` file for custom `src` Folder, default value is `Core`

The namespace is automatically added to the `psr-4` key of the compose.json file.

### Todo List

- [ ] Add CommandBus Contract
- [ ] Add Command and Handler Interface for UseCases
- [ ] Add custom Container Class
- [ ] Add binding for a CommandBus and Container Class

