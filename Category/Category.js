
window.onload = function ()
{
    var btnDelete = document.del;
    btnDelete.onclick = confirmDelete;
}
function confirmDelete() {
    if (confirm('¿Desea eliminar el registro?')) {
        return true;
    }
    return false;
}

