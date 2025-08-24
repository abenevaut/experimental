## Ma règle custom pour mes controllers

Chaque controller doit **toujours** :

- être dans le namespace `App\Controllers`
- étendre `abenevaut\Infrastructure\Http\Controllers\ControllerAbstract\ControllerAbstract`
- être `final`

@verbatim
    <code-snippet name="Structure basique d'un controller" lang="php">
    <?php

    namespace App\Controllers;

    use abenevaut\Infrastructure\Http\Controllers\ControllerAbstract;

    final class Controller extends ControllerAbstract {}
    </code-snippet>
@endverbatim
