<div class="mx-6">
    <div class="title text-left border-b-2 border-black mb-6 flex justify-between">
        <h1 class="text-3xl font-semibold">Your To Do List</h1>
        <a href="<?php echo ROOT_PATH; ?>lists/add" class="btn-common mb-1">Add An Item</a>
    </div>

    <div class="to-do-list striped flex flex-col justify-between items-start">

        <div class="to-do-heading grid grid-cols-12 gap-2 border-y-2 border-black w-full text-center">
            <div class="px-1 grid-cols-subgrid col-span-1 border-x-2 border-black">
                Check
            </div>
            <div class="grid-cols-subgrid col-span-5 border-r-2 border-black">
                Item Info
            </div>
            <div class="grid-cols-subgrid col-span-2 border-r-2 border-black">
                Due Date
            </div>
            <div class="grid-cols-subgrid col-span-2 border-r-2 border-black">
                Priority
            </div>
            <div class="grid-cols-subgrid col-span-2 px-1 border-r-2 border-black">
                Controls
            </div>
        </div>

        <?php foreach ($viewmodel as $item) : ?>
            <div class="to-do-item grid grid-cols-12 gap-2 border-b-2 border-black w-full">
                <div class="item_checkbox px-1 grid-cols-subgrid col-span-1 border-x-2 border-black flex justify-center items-center">
                    <input type="checkbox" name="check" class="check">
                </div>
                <div class="item_info grid-cols-subgrid col-span-5 border-r-2 border-black">
                    <p class="item_title text-2xl"><?php echo $item['title']; ?></p>
                    <p class="item_desc text-gray-500 overflow-hidden"><?php echo $item['description']; ?></p>
                </div>
                <div class="item_due-time grid-cols-subgrid col-span-2 border-r-2 border-black flex justify-center items-center">
                    <p><?php echo $item['duedate']; ?></p>
                </div>
                <div class="item_priority grid-cols-subgrid col-span-2 border-r-2 border-black flex justify-center items-center">
                    <p><?php echo $item['priority']; ?></p>
                </div>
                <div class="item_controls grid-cols-subgrid col-span-2 px-1 border-r-2 border-black flex justify-center items-center">
                    <a href="<?php echo ROOT_PATH; ?>lists/edit/<?php echo $item['id']; ?>" class="bg-yellow-500 hover:bg-yellow-400 text-gray-800 font-bold py-2 px-4 rounded mx-1">Edit</a>
                    <a href="<?php echo ROOT_PATH; ?>lists/delete/<?php echo $item['id']; ?>" class="bg-red-500 hover:bg-red-400 text-gray-800 font-bold py-2 px-4 rounded mx-1">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>