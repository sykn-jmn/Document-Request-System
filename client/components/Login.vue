<template>
  <div class="form-wrapper">
    <form class="login-form">
      <h1>Log In To Your Account</h1><br><br>
      <input type="text" id="email" name="email" placeholder="Email" v-model="email"><br><br>
      <input type="text" id="username" name="username" placeholder="Password" v-model="password"><br><br>
      <p class="text-center text-sky-600"><NuxtLink to="https://nuxtjs.org">Forgot your password?</NuxtLink></p><br><br>
      <div class="button-wrapper text-center">
          <button class="py-4 bg-yellow-400 rounded-full w-2/3 m-auto font-bold text-white" @click="login">LOGIN</button>
      </div><br><br>
      <p class="text-center text-sky-600">Don't have an account? <span class="underline font-bold"><NuxtLink to="https://nuxtjs.org">Signup</NuxtLink></span></p>
    </form>
  </div>
</template>

<script>
export default {

  setup(){
    const { $sanctumAuth } = useNuxtApp()
    const router = useRouter()
    const email = ref();
    const password = ref();

    const login = async() => {
      await $sanctumAuth.login({
          email: 'test@example.com',
          password: '123456789',
        },(data)=>{
          console.log(data);
          router.push('/user/dashboard')
        })
      }
      return{login, email, password}
    }
}

    



</script>

<style>

</style>