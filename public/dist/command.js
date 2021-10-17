/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ 17:
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Api": () => (/* binding */ Api)
/* harmony export */ });
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


/***/ }),

/***/ 19:
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Command": () => (/* binding */ Command)
/* harmony export */ });
/* harmony import */ var _Api_Api__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(17);


class Command{

    constructor(id,total,date,time,number,status,table_number,service_id){
        this.id = parseInt(id)
        this.date = date
        this.total = parseFloat(total)
        this.time = time
        this.number = parseInt(number)
        this.status = status
        this.table = parseInt(table_number)
        this.service = parseInt(service_id)
        this.api = new _Api_Api__WEBPACK_IMPORTED_MODULE_0__.Api("http://localhost/Coffee/public/index.php?p=api.command");
    }

    async list(){
        const commands = await this.api.list()
        return commands.results;
    }

    async find(id){
        const command = await this.api.find(id)
        return command.results;
    }

    async update(command){
        const res = await this.api.update(command)
        return res;
    }

    async insert(id){
        const res = await this.api.insert(command)
        return res;
    }

    async delete(id){
        const res = await this.api.delete(id)
    }

}



/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Command_Command__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(19);



const socket = io('http://localhost:3000', { transports : ['websocket'] });

class AdminCommand {

    constructor(api){
        this.api = api;
        this.command = []
        this.commands = new _Command_Command__WEBPACK_IMPORTED_MODULE_0__.Command()
        this.list()
    }

    async list(){
        const command = await this.commands.list();
        command.forEach(c =>{
            this.addCommand(new _Command_Command__WEBPACK_IMPORTED_MODULE_0__.Command(c.id,c.total,c.date,c.time,c.number,c.status,c.table_number,c.service_id))
        });
    }

    addCommand(command){
        this.command.push(command)
        const t = document.getElementById("commands");
        this.command.forEach(e => {
            const p = document.createElement('p')
            p.innerText = e.number;
            console.log(e)
            t.appendChild(p)
        })
    }
}

new AdminCommand()

})();

/******/ })()
;