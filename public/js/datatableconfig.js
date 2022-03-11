$('.datatable').DataTable({
    "language": {
        "lengthMenu": "Exibir _MENU_ resultados por página",
        "zeroRecords": "Nenhum registro encontrado",
        "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "infoEmpty": "Mostrando 0 até 0 de 0 registros",
        "infoFiltered": "(Filtrados de _MAX_ registros)",
        "search": "Pesquisar",
        "paginate": {
            "next": "Próximo",
            "previous": "Anterior",
            "first": "Primeiro",
            "last": "Último"
        }
    },
    "autoWidth": false,
    "responsive": true,
    "aaSorting": [[ 0, "desc" ]]
});