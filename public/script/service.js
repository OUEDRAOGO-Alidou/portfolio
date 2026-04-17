   document.getElementById('add-link').addEventListener('click', function() {
        const container = document.getElementById('links-container');
        const newGroup = document.createElement('div');
        newGroup.classList.add('link-group');
        newGroup.innerHTML = `
            <select name="platforms[]" required>
                <option value="">Choisir un réseau</option>
                <option value="facebook">Facebook</option>
                <option value="twitter">Twitter</option>
                <option value="linkedin">LinkedIn</option>
                <option value="instagram">Instagram</option>
                <option value="youtube">YouTube</option>
                <option value="github">GitHub</option>
            </select>
            <input type="url" name="urls[]" placeholder="https://..." required>
            <button type="button" class="remove-link">Supprimer</button>
        `;
        container.appendChild(newGroup);
    });

    document.getElementById('links-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-link')) {
            e.target.parentElement.remove();
        }
    });
