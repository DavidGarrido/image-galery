<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Galeria de imagenes</title>
    <style>
        body{
            margin:0px;
            height: 100vh;
            --primary: #ffd924;
            --secondary: #e5961d;
            --tertiari: #cf4310;
            background: 
                linear-gradient(var(--primary), transparent),
                linear-gradient(90deg, var(--secondary), transparent),
                linear-gradient(-90deg, var(--tertiari), transparent);
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: 120px auto;
            align-items: center;
        }
        body:hover{
            --primary: #71bfb1;
            --secondary: #5fa195;
            --tertiari: #c55d00;
        }
        body .full-img{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        body .container{
            display: flex;
            gap:10px;
            flex-wrap: nowrap;
            justify-content: center;
            overflow: auto;

        }
        body .container .image{
            width:100px;
            height: 100px;
            background-size: cover;
            background-position: center;
            border: 3px solid var(--tertiari);
            border-radius: 10px;
        }
        canvas{
            width: 80px;
            height: 100px;
            position: fixed;
            top:-100px;
            left: -100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <canvas id="canvas"></canvas>
        <script>
            window.addEventListener("load", function(event) {
                loadimg("{{$img[0]->url}}")
            })
            
        </script>
        @foreach ($img as $image)
            <div class="image" style="background-image: url('/storage/images/{{$image->url}}')" onclick="loadimg('{{$image->url}}')">
            </div>            
        @endforeach
    </div>
    <div class="full-img">
        <img src="" alt="" id="myImage">      
    </div>
        <script>
            window.CSS.registerProperty({
                name: '--primary',
                syntax: '<color>',
                inherits: true,
                initialValue: '#4AFF33'
            })
            window.CSS.registerProperty({
                name: '--secondary',
                syntax: '<color>',
                inherits: true,
                initialValue: '#3362FF'
            })
            window.CSS.registerProperty({
                name: '--tertiari',
                syntax: '<color>',
                inherits: true,
                initialValue: '#D033FF'
            })
            function loadimg (url){
                fetch('/storage/images/'+url)
                .then(response => response.blob())
                .then(blo => {
                    const domString = URL.createObjectURL(blo)
                    //console.log(domString)

                    var ctx = canvas.getContext('2d')
                    var img = new Image()
                    img.src = domString

                    img.onload = function(){
                    const domString = URL.createObjectURL(blo)
                    document.getElementById('myImage').setAttribute('src',domString)
                        ctx.clearRect(0,0,canvas.width, canvas.height)
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height)
                        const colors = getColorPalete(ctx)
                        //console.log(colors)
                        // console.log(colors.length)
                        updateProperties(colors)
                    }

                })
            }
            function getColorPalete (ctx){
                const imgData = ctx.getImageData(0,0,canvas.width,canvas.height)
                const quality = 270
                const colors = []
                for (let i = 0; i < canvas.width * canvas.height; i+=quality) {
                    const offset = i * 4
                    const alpha = imgData.data[offset + 3]
                    //console.log(alpha)
                    if (alpha > 0) {
                        const red = imgData.data[offset]
                        const green = imgData.data[offset + 1]
                        const blue = imgData.data[offset + 2]
                        if (red < 240 && blue < 240 && green < 240) {                            
                            colors.push({red, green, blue})
                            //console.log(`%c color: ${red},${green}, ${blue}`, `background: rgba(${red},${green}, ${blue}) `)
                        }
                    }
                }
                return colors
            }
            function updateProperties(color){
                const pri = parseInt(Math.random() * (color.length - 0) + 0) ;
                const sec = parseInt(Math.random() * (color.length - 0) + 0) ;
                const ter = parseInt(Math.random() * (color.length - 0) + 0) ;
                console.log(pri+' '+sec+' '+ter)
                document.body.style.setProperty('--primary', `rgb(${color[pri]['red']},${color[pri]['green']},${color[pri]['blue']})`)
                document.body.style.setProperty('--secondary',  `rgb(${color[sec]['red']},${color[sec]['green']},${color[sec]['blue']})`)
                document.body.style.setProperty('--tertiari',  `rgb(${color[ter]['red']},${color[ter]['green']},${color[ter]['blue']})`)
            }


        </script>
</body>
</html>