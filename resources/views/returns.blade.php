<x-header></x-header>
<x-layout>
    <!-- The box for the return-->
    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white p-8 md:p-12 rounded-xl border border-gray-100 shadow-2x1 items-center">
            <!-- Title -->
            <h2 class= "text-center md:text-3xl font-bold text-gray-800 mt-4 mb-4"> Returns Request</h2>
            <!-- return message -->
            <p class="text-gray-600 mb-8 text-center"> You can return items within 30 days of purchase. Please fill out the form and submit your return request.</p>
           <!-- <p class="mb-4 text-gray-700"> <strong> Order Number: </strong></p> -->
            <label class="block mb-4 font-medium"> Reason for Return </label>
            <!-- select the option for return -->
            <select class="w-full border rounded-lg p-3 mb-4">
                <option disabled selected> Select an option </option>
                <option> Wrong item recieved </option>
                <option> Wrong size/fit </option>
                <option> Defective Product </option>
                <option> Changed my mind </option>
                <option> Other </option>
</select>
 <!-- the additional details -->
<label class="block mb-4 font-medium"> Additional details </label>
<textarea rows="4" class="w-full border rounded-lg p-3 mb-4"></textarea>
 <!-- the submit button -->
<button class="block w-full rounded-lg bg-indigo-600 p-3 text-center text-lg font-bold text-white shadow-lg transition duration-200 hover:bg-indigo-700">
    Submit Your Request 
</button>

</div>
</div>
</x-layout>
<x-footer></x-footer>
