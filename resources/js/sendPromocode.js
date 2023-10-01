const submitButton = document.getElementById('send-promocode-button');
const promocode = document.getElementById('promocode-input');
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); 

submitButton.addEventListener('click', function (event) {
    event.preventDefault();

    fetch('/checkout/promocode/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
            name: promocode
        })
    }).then(response => {
        switch (response.message)
        {
            case '-1':
                alert('Такой промокод уже есть');
                break;
            case '0':
                alert('Промокод уже есть');
                break;
            case '1':
                alert('Промокод успешно добавлен');
                break;
        }
        //window.location.reload();
        console.log(response.json());
    });
});
