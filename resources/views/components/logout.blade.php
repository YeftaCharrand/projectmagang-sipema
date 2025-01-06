<div id="logoutModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full mx-4">
        <h2 class="text-lg font-semibold mb-4">Konfirmasi Logout</h2>
        <p class="mb-6">Anda yakin ingin Log Out?</p>
        <div class="flex justify-end space-x-4">
            <button class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded" onclick="closeLogoutModal()">Batal</button>
            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded" onclick="confirmLogout()">Log Out</button>
        </div>
    </div>
</div>

<script>
function openLogoutModal() {
    document.getElementById('logoutModal').classList.remove('hidden');
}

function closeLogoutModal() {
    document.getElementById('logoutModal').classList.add('hidden');
}

function confirmLogout() {
    document.getElementById('logout-form').submit();
}
</script>