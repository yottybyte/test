export default async function guest ({ next, store }){
    if(store.isAuth){
        return next({
            name: 'profile'
        })
    }

    return next()
}
