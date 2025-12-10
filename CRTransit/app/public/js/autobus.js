
document.getElementById('formAgregarBus').addEventListener('submit', async function(e){
  e.preventDefault();
  const data = new FormData(this);

  try {
    const res = await fetch('../../controller/agregarBus.php', {
      method: 'POST',
      body: data
    });

    const json = await res.json();

    if (json.ok) {
      Swal.fire('Agregado', json.mensaje, 'success').then(()=> location.reload());
    } else {
      Swal.fire('Error', json.mensaje, 'error');
    }

  } catch (err) {
    Swal.fire('Error', 'Error de conexión', 'error');
  }
});



document.querySelectorAll('.btn-eliminar').forEach(btn => {
  btn.addEventListener('click', function(){
    const tr = this.closest('tr');
    const idBus = tr.dataset.id;

    Swal.fire({
      title: 'Eliminar autobús?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Eliminar'
    }).then(async (result) => {

      if (result.isConfirmed) {
        try {
          const res = await fetch('../../controller/eliminarBus.php', {
            method: 'POST',
            headers: {'Content-Type':'application/json'},
            body: JSON.stringify({idBus})
          });

          const json = await res.json();

          if (json.ok) {
            Swal.fire('Eliminado', json.mensaje, 'success').then(()=> location.reload());
          } else {
            Swal.fire('Error', json.mensaje, 'error');
          }

        } catch (err) {
          Swal.fire('Error', 'Error de conexión', 'error');
        }
      }

    });
  });
});
