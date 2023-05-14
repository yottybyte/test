export default async function auth ({ next, store }){
    if(!store.isAuth){
        return next({
            name: 'login'
        })
    }
    return next()
}
