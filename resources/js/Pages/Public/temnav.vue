<template>
    <nav class="nav-links">
        <div class="group inline-block relative">
            <a class="flex items-center mr-5 hover:text-gray-900" href="https://google.com">
                <span class="flex items-center">Repairs
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg></span>
            </a>
            <ul class="animated-menu absolute hidden text-gray-700 pt-1 group-hover:block">
                <li>
                    <a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                        href="#">One</a>
                </li>
                <li>
                    <a class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="#">Two</a>
                </li>
                <li>
                    <a class="rounded-b bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="#">Three
                        is the magic number</a>
                </li>
            </ul>
        </div>
        <div>
            <a class="mr-5 hover:text-gray-900">Second Link</a>
        </div>
        <div>
            <a class="mr-5 hover:text-gray-900">Third Link</a>
        </div>
    </nav>

</template>