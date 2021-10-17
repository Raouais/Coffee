class Api{

    constructor(url,id){
        this.url = url 
        this.id = id
    }

    setUrl(url){
        this.url = url + this.id
    }

    async list(){
        const res = await fetch(this.url, {
            method: 'GET'
            // headers: this.headers,
        })
        const data = await res.json()
        return data
    }
    
    async insert(value){
        const res = await fetch(this.url,{
            method: 'POST',
            body: JSON.stringify(value)
        })
        return res
    } 

    async delete(value) {
        const res = await fetch(this.url, {
            method: 'DELETE',
            body: JSON.stringify(value)
        })
    }

    async update(value) {
        const res = await fetch(this.url, {
            method: 'PATCH',
            body: JSON.stringify(value)
        })
    }
}
export { Api }