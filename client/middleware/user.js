export default async function ({ store, redirect }) {
  // console.log(store.state.auth)
  if (store.state.auth.strategy == "adminAuth") {
    return redirect("/admin/dashboard");
  }
}
