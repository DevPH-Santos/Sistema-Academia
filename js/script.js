function searchClient() {
    const input = document.getElementById('searchInputClient');
    const filter = input.value.toUpperCase();
    const rows = document.getElementById('clientTable').getElementsByTagName('tr');
    
    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        if (cells.length > 0) {
            const nameCell = cells[1];
            if (nameCell) {
                const txtValue = nameCell.textContent || nameCell.innerText;
                rows[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? '' : 'none';
            }
        }
    }
}

function searchProgress() {
    const input = document.getElementById('searchInputProgress');
    const filter = input.value.toUpperCase();
    const rows2 = document.getElementById('progressTable').getElementsByTagName('tr');
    
    for (let i = 0; i < rows2.length; i++) {
        const cells = rows2[i].getElementsByTagName('td');
        if (cells.length > 0) {
            const nameCell = cells[0]; // Ajuste para a coluna correta do cliente em progressos
            if (nameCell) {
                const txtValue = nameCell.textContent || nameCell.innerText;
                rows2[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? '' : 'none';
            }
        }
    }
}