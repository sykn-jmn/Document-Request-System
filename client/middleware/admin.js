export default async function ({ store, redirect }) {
  // console.log(store.state.auth)
  if (store.state.auth.strategy == "userAuth") {
    return redirect("/user/dashboard");
  }
}
