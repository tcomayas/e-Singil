<style scoped>
    @media (max-width: 640px) {
        #search {
            display: flex;
            justify-content: flex-end;
        }
    }
</style>

<form action="/">
    <div class="flex justify-end" id="search">
        <div class="relative flex mt-4 mb-4 border-2 border-gray-100 rounded-lg w-100">
            <div class="relative mx-2 top-4">
            </div>
            <input type="text" name="search" class="z-0 w-full pr-20 rounded-lg h-14 focus:shadow focus:outline-none"
                placeholder="Search Product..." />
            <div class="absolute top-2 right-2">
                <button type="submit"
                    class="w-20 h-10 text-black bg-blue-300 rounded-lg hover:bg-green-600 opacity-90">
                    Search
                </button>
            </div>
        </div>
    </div>
</form>
