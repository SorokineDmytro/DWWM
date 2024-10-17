<div>
    <h1>Rechercher</h1>
    <input type="text" name="text" id="text">
    <div id="list"></div>
</div>

<script>
    let text = document.getElementById('text');
    let list = document.getElementById('list');

    text.addEventListener('input', (event) => {
        let valeur = event.target.value;
        if(valeur) {
            let data = new FormData();
        data.append('mot', valeur);

        fetch("test1.php?action=autocomplete", {
            method: "POST",
            body: data,
        })
        .then(response => response.json())
        .then(dataR => {
            // remplir le formulaire aavec des data Retournes
            let html = '';
            dataR.forEach(item => {
                html += `
                    <p>${item.designation}</p>
                `;
            });
            list.innerHTML = html;
        })
        } else {
            list.innerHTML = "";
        }
    });
    list.addEventListener('click', (event) => {
        text.value = event.target.textContent;
        list.innerHTML = "";
    });
</script>