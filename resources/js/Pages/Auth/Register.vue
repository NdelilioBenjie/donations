<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/Inputs/SelectInput.vue';
import { VueTelInput } from 'vue-tel-input';
import { MinusIcon, PlusIcon } from '@heroicons/vue/24/outline';

const form = useForm({
    first_name: '',
    last_name: '',
    phone: '',
    email: '',
    amount: 100,
    schedule: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const schedules = ref([
    {
        id: 1,
        name: "One Off"
    }, 
    {
        id: 2,
        name: "Monthly"
    }, 
    {
        id: 3,
        name: "Annually"
    }
])

const decementQuantity = () => {
    if (form.amount >= 10) {
        form.amount -= 50
    }
}

const incrementQuantity = () => {
    if (form.amount <= 70000) {
        form.amount += 50
    }
}

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <form @submit.prevent="submit">
            <div class="flex gap-4">
                <div>
                    <InputLabel for="first_name" value="First Name" />
                    <TextInput
                        id="first_name"
                        v-model="form.first_name"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="first_name"
                    />
                    <InputError class="mt-2" :message="form.errors.first_name" />
                </div>

                <div>
                    <InputLabel for="last_name" value="Last Name" />
                    <TextInput
                        id="last_name"
                        v-model="form.last_name"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autocomplete="last_name"
                    />
                    <InputError class="mt-2" :message="form.errors.last_name" />
                </div>
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel value="Phone"
                            class="mb-2" />
                <VueTelInput v-model="form.phone"
                                mode="international"
                                :preferred-countries="['KE']" />
                <InputError :message="form.errors.phone"
                            class="mt-2" />
            </div>

            <div class="mt-4">
                <SelectInput v-model="form.schedule"
                                :options="schedules"
                                :id="'id'"
                                :name="'name'"
                                :placeholder="'Schedule'" />

                <InputError :message="form.errors.schedule" class="mt-2" />
                <InputError :message="form.errors['schedule.name']" class="mt-2" />
            </div>

            <div class="mt-4">
                <InputLabel for="first_name" value="Amount (KES)" />
                <div class="flex items-center gap-4 mt-1">
                    <PrimaryButton @click="decementQuantity()"
                                    :type="'button'">
                        <MinusIcon class="h-4 w-4 flex-shrink-0"
                                    aria-hidden="true" />
                    </PrimaryButton>

                    <div class="grow">
                        <TextInput
                            id="amount"
                            v-model="form.amount"
                            type="number"
                            class="block w-full text-center"
                            required
                        />
                    </div>

                    <PrimaryButton @click="incrementQuantity()"
                                    :type="'button'">
                        <PlusIcon class="h-4 w-4 flex-shrink-0"
                                    aria-hidden="true" />
                    </PrimaryButton>
                </div>

                <InputError :message="form.errors.amount" class="mt-2" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Privacy Policy</a>
                        </div>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </InputLabel>
            </div>

            <div class="mt-4">
                <PrimaryButton class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>

            <div class="flex items-center justify-center gap-1 text-sm text-gray-600 mt-4">
                Already have an account?
                <Link :href="route('login')" class="underline hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Register
                </Link>
            </div>
        </form>
    </AuthenticationCard>
</template>
