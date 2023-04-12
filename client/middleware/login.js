export default async function ({ store, redirect, router }) {
  // console.log(store.state.auth)
  if (store.state.auth.loggedIn) {
    if (store.state.auth.strategy == "userAuth") {
      return redirect("/user/dashboard");
    } else {
      return redirect("/admin/dashboard");
    }
  }
  return redirect("/");
}
