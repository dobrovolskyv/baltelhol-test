import { ref } from 'vue';


export function useAuth() {
    const token = ref(localStorage.getItem('admin_token'));

    const checkAndRedirect = () => {
        if (!token.value) {
            router.visit('/login');
            return false;
        }
        return true;
    };

    return { token, checkAndRedirect };
}

// import { ref } from 'vue'
// import { router } from '@inertiajs/vue3'
//
// // Реактивная переменная, которая хранит текущий токен
// const token = ref(localStorage.getItem('admin_token'))
//
// export function useAuth() {
//     const setToken = (newToken) => {
//         token.value = newToken
//         if (newToken) {
//             localStorage.setItem('admin_token', newToken)
//         } else {
//             localStorage.removeItem('admin_token')
//         }
//     }
//
//     const clearToken = () => setToken(null)
//
//     const checkAndRedirect = () => {
//         if (!token.value) {
//             router.visit('/login')
//         }
//     }
//
//     return { token, setToken, clearToken, checkAndRedirect }
// }
