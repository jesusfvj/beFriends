// Logout if not exist user in database
fetch(`./controllers/users.php?controller=logoutinvaliduser`)
    .then((res) => res.json())
    .then((data) => {});