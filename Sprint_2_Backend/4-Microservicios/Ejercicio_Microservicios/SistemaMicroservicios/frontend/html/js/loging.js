const submit = document.getElementById('submit');

submit.addEventListener('click', login);

function login() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    
    console.log('Submit');

    fetch('http://localhost:5002/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, password })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.valid) {
            alert('Login successful');
        } else {
            alert('Invalid username or password');
        }
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
        alert('An error occurred during login. Please try again.');
    });
}
