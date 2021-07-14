<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to CodeIgniter 4!</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

<body>
    <form action="signup/new" method="post">
        <div>
            <input type="text" name="username" placeholder="Username">
        </div>
        <div>
            <input type="text" name="password" placeholder="Password">
        </div>
        <div>
            <input type="text" name="name" placeholder="Name">
        </div>
        <div>
            <input type="email" name="email" placeholder="Email">
        </div>
        <div>
            <select name="type">
                <option value="1">Student</option>
                <option value="2">Teacher</option>
            </select>
        </div>
        <div>
            <button type="submit">Daftar</button>
        </div>
    </form>

</body>
</html>
