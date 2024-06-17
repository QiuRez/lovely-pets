<template>
    <Header />
    <h4 class="titleAuth">Регистрация</h4>
        <Form
            action="#"
            method="post"
            class="authForm"
            :validation-schema="schema"
            v-slot="{ errors,  isSubmitting }"
            @submit="onSubmit"
        >
            <label for="">
                Имя пользователя
                <Field
                    name="username"
                    type="text"
                    :class="errors.username ? 'fieldError' : ''"
                />
<!--                <span v-if="props?.errors?.username">Имя пользователя уже занято</span>-->
            </label>
            <label for="">
                Почта
                <Field
                    name="email"
                    type="email"
                    :class="errors.email ? 'fieldError' : ''"
                />
<!--                <span v-if="props?.errors?.email">Такая почта уже существует</span>-->
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
                Повторите пароль
                <Field
                    name="password_confirmation"
                    type="password"
                    :class="errors.password_confirmation ? 'fieldError' : ''"
                />
            </label>
            <label for="" id="labelRemember">
                Запомнить меня
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
</template>

<script setup>
import { router } from "@inertiajs/vue3"
import * as yup from 'yup'
import { Form, Field } from "vee-validate";
import Header from "../Components/Header.vue";

const props = defineProps(['errors', 'csrf_token', 'data'])

const schema = yup.object().shape({
    username: yup.string().required().min(3).max(255),
    email: yup.string().required().email(),
    password: yup.string().required().min(6),
    password_confirmation: yup.string()
        .oneOf([yup.ref('password')], 'Пароли не совпадают').required(),
    remember: yup.bool()
})

function onSubmit(values)
{
    router.post('/users/register', {
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
