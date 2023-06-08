<script>

let data = localStorage.getItem('nurses')
data = JSON.parse(data)
if (data){



for(let i = 0; i < data.length; i++) {
    document.write(data[i])

}

} else document.write('Пусто')

</script>