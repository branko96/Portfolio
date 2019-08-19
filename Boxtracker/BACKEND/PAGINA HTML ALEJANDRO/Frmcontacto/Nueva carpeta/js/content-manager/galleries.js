define(['js/content-manager/common'], function (common) {
    /**
    * This object contains all the public API methods related to the content manager's image gallery
    * Note that the images web services are deprecated and should be reimplemented (like the notice web service is)
    *
    * @module content-manager/galleries
    * @class Galleries
    */
    var api = {
        /**  
        * Gets all the images from a gallery
        *
        * @method GetGalleryImages
        * @param {Function} success A callback function if the call was successful
        * @param {Function} error A callback function if the call failed
        * @param {Integer} id The id of the gallery
        */
        GetGalleryImages: function (success, error, id) {
            var data = {
                IDGaleria: id
            };
            common.ajax('POST', 'Contentmanager/Gestor_Imagenes.asmx/ObtenerImagenesPorGaleria', data, success, error);
        },

        /**  
        * Gets all the galleries info
        *
        * @method GetGalleries
        * @param {Function} success A callback function if the call was successful
        * @param {Function} error A callback function if the call failed
        */
        GetGalleries: function (success, error) {
            common.ajax('POST', 'Contentmanager/Gestor_Imagenes.asmx/ObtenerGalerias', null, success, error);
        },

        /**  
        * Gets the footnote of a gallery image
        *
        * @method GetFootnote
        * @param {Function} success A callback function if the call was successful
        * @param {Function} error A callback function if the call failed
        * @param {Integer} id The id of the image
        */
        GetFootnote: function (success, error, id) {
            var data = {
                IDImagen: id
            };
            common.ajax('POST', 'Contentmanager/Gestor_Imagenes.asmx/getNotaDePieImg', data, success, error);
        }
    };

    return api;
});