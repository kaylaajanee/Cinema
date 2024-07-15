<!DOCTYPE html>
<html>
<head>
    <title>Generate Random String</title>
    <script>
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

        function generateString() {
            let result = ' ';
            let length = 5;
            const charactersLength = characters.length;
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        function handleClick() {
            const generatedString = generateString();
            console.log(generatedString);
            document.getElementById('result').textContent = generatedString;
        }
    </script>
</head>
<body>
    <button onclick="handleClick()">Generate String</button>
    <p id="result"></p>
</body>
</html>
