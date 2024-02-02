<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="/src/assets/css/main.css" rel="stylesheet">
    <title>To Do List</title>
</head>

<body>
    <nav class="shadow bg-black mb-3">
        <div class="mx-auto h-16">
            <div class="flex items-center space-x-5 flex-wrap text-white" style="height: 100%;">
                <div class="App_logo ml-4">
                    <a href="<?php echo ROOT_PATH; ?>" class="App_nav-logo">
                        ToDoList
                    </a>
                </div>
                <ul class="exo-menu">
                    <li class="float-left mx-3">
                        <a href="<?php echo ROOT_PATH; ?>">
                            Home
                        </a>
                    </li>
                    <li class="float-left mx-3">
                        <a href="<?php echo ROOT_PATH; ?>lists">
                            Your To Do List
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main role="main" class="mt-16">

        <div>
            <?php require($view); ?>
        </div>

    </main>
</body>
<script src="/src/assets/js/main.js"></script>

</html>