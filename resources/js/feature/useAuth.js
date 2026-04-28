import {ref} from 'vue';
import {router} from '@inertiajs/vue3'


export function useAuth() {
    const token = ref(localStorage.getItem('admin_token'));

    const checkAndRedirect = () => {
        if (!token.value) {
            router.visit('/login');
            return false;
        }
        return true;
    };

    return {token, checkAndRedirect};
}
