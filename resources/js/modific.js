const selectItems = document.getElementById('items');
document.addEventListener('DOMContentLoaded', function() {

    let item = undefined; // Declare and initialize the item variable

    selectItems.addEventListener('change', function() {
        const selectedItemValue = JSON.parse(selectItems.value);

        // Parse the string as an object
        item = {
            id: selectedItemValue.id,
            nome: selectedItemValue.nome,
            imagem: selectedItemValue.imagem.substring(7),
            tipo_de_documento: selectedItemValue.tipo_de_documento,
            local_de_encontrado: selectedItemValue.local_de_encontrado,
            descricao: selectedItemValue.descricao,
            contacto: selectedItemValue.contacto
        };
        console.log(item);
    });

    const selectButton = document.getElementById('select-item');
    const inputsDiv = document.getElementById('inputs');
    const selectDiv = document.getElementById('selecionar');

    selectButton.addEventListener('click', function() {
        console.log(item)
        if (item === undefined) {
            alert('Por favor, selecione um item.'); // Display an alert message
            return; // Exit the function if no item is selected
        }
                // Convert the JSON string back into an object

                // Update the values of other input fields with the selected item data
                document.getElementById('item_id').value = item.id;
                document.getElementById('nome').value = item.nome;

                document.getElementById('tipo_de_documento').value = item.tipo_de_documento; // Reset the select option value
                document.getElementById('local_de_encontrado').value = item.local_de_encontrado;
                document.getElementById('descricao').value = item.descricao;
                document.getElementById('contacto').value = item.contacto;
                document.getElementById('foto').value = item.imagem;

                inputsDiv.style.display = 'block';
                selectDiv.style.display = 'none';
    })

    const cancelButton = document.getElementById('cancelar');

    cancelButton.addEventListener('click', function() {
        inputsDiv.style.display = 'none';
        selectDiv.style.display = 'block';
    });
});
