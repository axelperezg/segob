export default class DependencyPresenter {
    constructor(dependency) {
        this.dependency = dependency
    }

    get id() {
        return this.dependency.id
    }

    get name() {
        return this.dependency.name
    }

    get slug() {
        return this.dependency.slug
    }

    get image() {
        return this.dependency.image
    }

    get banner() {
        return this.dependency.banner
    }
}
