window.onload = () => {


    let canvasWidth = 900
    let canvasHeight = 600
    let modify = document.getElementById('modify')
    let addtable = document.getElementById('add')
    let canvas = document.createElement('canvas')
    canvas.style.border = "3px solid gray"
    canvas.style.margin = "50px auto"
    canvas.style.display = "flex"
    canvas.style.backgroundColor = "#fff"
    document.body.appendChild(canvas)
    let ctx = canvas.getContext('2d')
    canvas.width = canvasWidth
    canvas.height = canvasHeight    
    let isModifying = false
    let isInserting = true
    
    addtable.addEventListener('click', e => {
        if(isInserting){
            let cvs = document.createElement('canvas')
            cvs.style.border = "3px solid gray"
            cvs.style.margin = "50px auto"
            cvs.style.display = "flex"
            cvs.style.backgroundColor = "#fff"
            cvs.width = canvasWidth
            cvs.height = 250    
            let c = cvs.getContext('2d')
            c.save();
            c.font = "bold 20px sans-serif";
            c.fillStyle = "#000";
            c.textAlign = "center";
            c.textBaseline = "middle";
            c.strokeStyle = "white";
            c.lineWidth = 5;
            var centreX = canvasWidth / 4;
            var centreY = canvasHeight / 3;
            c.strokeText("Separateurs", centreX, centreY - 180);
            c.fillText("Separateurs", centreX, centreY - 180);

            let walls = [new Wall([30,60],[15,150]),new Wall([70,135],[15,75]), new Wall([180,120],[150,15]),new Wall([180,160],[75,15])]
            walls.forEach(w => w.draw())

            c.fillStyle = '#000'
            c.fillRect(cvs.width/2, 0, 5, cvs.height)
            c.beginPath()

            let tables = [new Table([480,90],[100,100]),new Table([600,140],[50,50]),new Table([720,140],[100,100],""),new Table([810,165],[50,50],c,"")]

            c.strokeText("Tables", centreX * 3, centreY - 180);
            c.fillText("Tables", centreX * 3, centreY - 180);
            c.restore();


            isInserting = false;
            document.body.insertBefore(cvs,canvas)
        } else if(!isInserting){
            document.body.removeChild(document.querySelector('canvas'))
            isInserting = true
        }
    })
    
    modify.addEventListener('click', e => {
        if(isModifying){
            isModifying = false
            modify.textContent = 'Modifier'
            modify.className = "btn btn-danger"
            defaultTable()
        } else {
            isModifying = true
            modify.textContent = "Enregistrer"
            modify.className = "btn btn-success"
        } 
    })

    let table = new Table([120,250],[100,100],ctx,"circle");  
    let table2 = new Table([120, 60],[100,100],ctx);
    let el = [table,table2]
    let isTableSelected = false
    let elIndex;
    
    const rect = canvas.getBoundingClientRect();
    
    
    canvas.addEventListener('mousedown', handleMouseDown, true)
    canvas.addEventListener('mouseup', handleMouseUp, true)
    canvas.addEventListener('mousemove', handleMouseMove, true)
    
    canvas.addEventListener("touchstart", handleStart, false);
    canvas.addEventListener("touchend", handleEnd, true);
    canvas.addEventListener("touchmove", handleMove, false);
    
    
    function isNotAtLimitBox(x,y){
        if(x >= 0 && x + el[elIndex].size[0] <= canvasWidth && y >= 0 && y + el[elIndex].size[1] <= canvasHeight)
            return true
        return false
    }
    
    function keepElements(){
        ctx.clearRect(0,0,canvasWidth,canvasHeight)
        el.forEach(t => t.draw())
    }
   
    function showCord(x,y){
        console.log('cord: ', x + ', ' + y)
    }

    function defaultTable(){
        el.forEach(t => {t.selected = false; t.setColor();})
    }

    function handleEnd(e){
        e.preventDefault()
        if(isTableSelected){
            isTableSelected = false
        }
    }

    function handleMove(e){
        e.preventDefault();
        let x
        let y
        for(let i = 0; i < e.changedTouches.length; i++) {
            x = parseInt(e.changedTouches[i].pageX) - rect.left;
            y = parseInt(e.changedTouches[i].pageY) - rect.top;
            if(isTableSelected && isNotAtLimitBox(x - 50,y - 50) && isModifying){
                el[elIndex].setPosition(x -50,y - 50)
                keepElements()
            }
        }
    }


    function handleStart(e) {
        e.preventDefault();
        let x
        let y
        let isTableTouched = false
        for(let i = 0; i < e.changedTouches.length; i++) {
            x = parseInt(e.changedTouches[i].pageX) - rect.left;
            y = parseInt(e.changedTouches[i].pageY) - rect.top;
        }
        el.forEach(t => {
            if( isModifying && (x >= t.position[0] && x <= t.position[0] + t.size[0]) && (y >= t.position[1] && y <= t.position[1] + t.size[1])){
                isTableSelected = true
                elIndex = el.indexOf(t)
                t.selected = true
                t.setColor()
                isTableTouched = true
            } else {
                t.selected = false
                t.setColor()
            }
        })
        if(!isTableTouched){
            defaultTable()
        }
    }

    function handleMouseMove(e) {
        if(isTableSelected){
            let x = e.clientX - rect.left
            let y = e.clientY - rect.top
            table.setPosition(x,y)
        }
    }

    function handleMouseDown(e){
        let x = e.clientX - rect.left
        let y = e.clientY - rect.top
        if((x >= table.position[0] && x <= table.position[0] + table.size) && (y >= table.position[1] && y <= table.position[1] + table.size)){
            isTableSelected = true
            handleMouseMove(e)
        }
    }

    function handleMouseUp(e) {
        if(isTableSelected){
            isTableSelected = false
        }
    }

    
}