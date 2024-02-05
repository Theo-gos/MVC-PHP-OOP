<div class="text-center border-2 border-gray-200 mx-auto w-1/2 flex flex-col justify-center">
    <div class="card-text my-2">
        <p class="text-lg">Are you sure you want to delete this post? This cannot be undone.</p>
    </div>
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" class="form flex justify-center my-3">
        <input type="hidden" name="id" value="<?php echo $viewmodel['id']; ?>" />
        <input type="submit" name="submit" class="shadow bg-red-500 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded mx-2" value="Yes, delete now" style="cursor: pointer;" />
        <a class="bg-gray-200 hover:bg-gray-400 text-black font-bold py-2 px-4 focus:outline-none focus:shadow-outline rounded mx-2" href="<?php echo ROOT_PATH; ?>lists">Nevermind</a>
    </form>
</div>