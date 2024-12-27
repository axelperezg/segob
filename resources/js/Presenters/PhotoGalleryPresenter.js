export default class PhotoGalleryPresenter {
    constructor(photoGallery) {
        this.photoGallery = photoGallery;
    }

    get id() {
        return this.photoGallery.id;
    }

    get name() {
        return this.photoGallery.name;
    }

    get isPublished() {
        return this.photoGallery.is_published;
    }

    get publishedAt() {
        return this.photoGallery.published_at;
    }

    get photos() {
        return this.photoGallery.photos;
    }

    get thumbnail() {
        return this.photoGallery.image;
    }
} 