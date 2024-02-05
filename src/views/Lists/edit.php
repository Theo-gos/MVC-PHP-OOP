<div class="card col col-lg-5 mx-3 mx-lg-auto p-0">
    <div class="title text-left border-b-2 border-black mb-6 flex justify-between">
        <h3 class="text-3xl font-semibold">Your To Do</h3>
    </div>

    <form class="w-full max-w-lg mx-auto" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <div class="flex flex-wrap -mx-3 mb-6 justify-between">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 flex-grow">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
                    Title
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="title" id="title" type="text" value="<?php echo $viewmodel['title']; ?>">
                <p class="text-red-500 text-xs italic hidden">Please fill out this field.</p>
            </div>

            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="prio">
                    Priority
                </label>
                <div class="relative">
                    <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="prio" id="prio" value="<?php echo $viewmodel['priority']; ?>">
                        <option value="high">High</option>
                        <option value="mid">Mid</option>
                        <option value="low">Low</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="desc">
                    Description
                </label>
                <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-48" name="desc" id="desc"><?php echo $viewmodel['description']; ?></textarea>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 flex-grow">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="due">
                    Due Date
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="due" id="due" type="date" require value="<?php echo $viewmodel['duedate']; ?>">
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <input type="hidden" name="id" value="<?php echo $viewmodel['id']; ?>" />
            <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline rounded mx-2" name="submit" type="submit" value="Submit" />
            <a class="shadow bg-red-500 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" href="<?php echo ROOT_PATH; ?>lists">Cancel</a>
        </div>
    </form>
</div>