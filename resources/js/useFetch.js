/**
 * Fetch personalizado para recibir respuestas y errores desde laravel
 * 
 * Es necesario enviar la información con las funciones successFetch o errorFetch
 * provistas en el controlador padre en laravel.
 */
export default async function useFetch(url, method = 'GET') {
    let response = null;
  
    await fetch(url, {
            method: method,
            cache: 'no-cache'
        })
        .then((res) => res.json())
        .then((res) => {
            if(res.status != 200) {
                Notify.error(res.message);
                throw new Error(res.message);
            } else {
                response = res;
            }
        });
    
    return response;
}