<template>
    <Header />
    <h4 class="titleAuth">Вход</h4>
    <div class="authBlock">
        <Form
            action="#"
            method="post"
            class="authForm"
            :validation-schema="schema"
            v-slot="{ errors,  isSubmitting }"
            @submit="onSubmit"
        >
            <span v-if="page.props.AuthError">{{ page.props.AuthError }}</span>
            <label for="">
                Почта
                <Field
                    name="email"
                    type="email"
                    :class="errors.email ? 'fieldError' : ''"
                />
            </label>
            <label for="">
                Пароль
                <Field
                    name="password"
                    type="password"
                    :class="errors.password ? 'fieldError' : ''"
                />
            </label>
            <label for="">
                <Field
                    name="remember"
                    type="checkbox"
                    :value="true"
                />
            </label>
            <button
                type="submit"
                :disabled="isSubmitting"
            >
                Зарегистрироваться
            </button>
        </Form>
    </div>
</template>

<script setup>
import { router, usePage } from "@inertiajs/vue3"
import * as yup from 'yup'
import { Form, Field } from "vee-validate";
import Header from "../Components/Header.vue";

const props = defineProps(['errors', 'csrf_token', 'data'])

const page = usePage()

console.log(page.props)

const schema = yup.object().shape({
    email: yup.string().required().email(),
    password: yup.string().required().min(6),
    remember: yup.bool()
})

function onSubmit(values)
{
    router.post('/users/login', {
        ...values,
        _token: props.csrf_token
    }, {
        preserveState: true,
        onSuccess: (response) => {
            console.log(response.props)
        }
    })
}

</script>
