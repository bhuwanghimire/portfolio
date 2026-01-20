// import toastr from 'toastr';
// import 'toastr/build/toastr.min.css';
// import Swal from 'sweetalert2';
//
// // -------------------------
// // TOASTR CONFIG
// // -------------------------
// toastr.options = {
//     closeButton: true,
//     progressBar: true,
//     positionClass: 'toast-top-right',
//     timeOut: 3000,
//     showMethod: 'fadeIn',
//     hideMethod: 'fadeOut'
// };
//
// // Make toastr global
// window.toastr = toastr;
//
// // Listen for Livewire toast events
// document.addEventListener('livewire:init', () => {
//     Livewire.on('toast', (event) => {
//         const data = event[0] || event;
//         toastr[data.type](data.message);
//     });
//
//     // Listen for Swal events
//     Livewire.on('swal:education', (event) => {
//         const data = Array.isArray(event) ? event[0] : event;
//
//         Swal.fire({
//             title: data.title,
//             text: data.text,
//             icon: data.icon,
//             showCancelButton: true,
//             confirmButtonText: data.confirmButtonText,
//             cancelButtonText: data.cancelButtonText,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 Livewire.dispatch('removeEducation', {
//                     id: data.id
//                 });
//             }
//         });
//     });
//     Livewire.on('swal:experience', (event) => {
//         const data = Array.isArray(event) ? event[0] : event;
//
//         Swal.fire({
//             title: data.title,
//             text: data.text,
//             icon: data.icon,
//             showCancelButton: true,
//             confirmButtonText: data.confirmButtonText,
//             cancelButtonText: data.cancelButtonText,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 Livewire.dispatch('removeExperience', {
//                     id: data.id
//                 });
//             }
//         });
//     });
//
//     Livewire.on('swal:service', (event) => {
//         const data = Array.isArray(event) ? event[0] : event;
//
//         Swal.fire({
//             title: data.title,
//             text: data.text,
//             icon: data.icon,
//             showCancelButton: true,
//             confirmButtonText: data.confirmButtonText,
//             cancelButtonText: data.cancelButtonText,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 Livewire.dispatch('removeService', {
//                     id: data.id
//                 });
//             }
//         });
//     });
//
//     Livewire.on('swal:skill', (event) => {
//         const data = Array.isArray(event) ? event[0] : event;
//
//         Swal.fire({
//             title: data.title,
//             text: data.text,
//             icon: data.icon,
//             showCancelButton: true,
//             confirmButtonText: data.confirmButtonText,
//             cancelButtonText: data.cancelButtonText,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 Livewire.dispatch('removeSkill', {
//                     id: data.id
//                 });
//             }
//         });
//     });
//
//     Livewire.on('swal:interest', (event) => {
//         const data = Array.isArray(event) ? event[0] : event;
//
//         Swal.fire({
//             title: data.title,
//             text: data.text,
//             icon: data.icon,
//             showCancelButton: true,
//             confirmButtonText: data.confirmButtonText,
//             cancelButtonText: data.cancelButtonText,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 Livewire.dispatch('removeInterest', {
//                     id: data.id
//                 });
//             }
//         });
//     });
//
//
//
//
//
//
// });
//
// // Make Swal global
// window.Swal = Swal;
//
// // Optional: global helper for Swal
// window.showSwal = (options) => {
//     Swal.fire(options);
// };
