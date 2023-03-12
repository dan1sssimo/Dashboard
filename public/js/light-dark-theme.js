// // let switchMode = document.getElementById("switchTestMode");
// //
// // switchMode.onclick = function () {
// //     let theme = document.getElementById("theme");
// //     console.log('theme:', theme);
// //     if(theme.getAttribute("href") == "/css/light-mode.css") {
// //         theme.href = "/css/dark-mode.css";
// //         console.log("the theme is changed on the dark");
// //     } else {
// //         theme.href = "/css/light-mode.css";
// //         console.log("the theme is changed on the light");
// //
// //     }
// // }
//
// function test4(id) {
//     $('#box-4').append(`
//     <div class="panel-report ${id}">
//         <div class="progress-report">
//             <div id="target" class="target"></div>
//             <div id="limit" class="limit"></div>
//             <div id="progress-done" class="progress-done"></div>
//         </div>
//         <div class="panel-report-1">
//             <div class="panel-report-degrees">0</div>
//             <div class="panel-report-info">
//                 <div class="panel-report-name"></div>
//                 <div class="panel-report-rates">0</div>
//             </div>
//         </div>
//     </div>
//     `)
// }
//
// /*GAP RAPORT*/
// let arrayNameCard = [
//     'Knowledge Progress',
//     'Client Impact',
//     'Team Impact',
//     'Skill Progress',
//     'Material Progress - Pay & Benefits',
//     'Team & Leadership Ethics',
//     'Organization Impact',
//     'Societal Impact Size',
//     'Project Impact',
//     'Organization Culture',
//     'Character Culture',
//     'Role Progress',
//     'Task Impact',
//     'Social Progress',
//     'Social Positive Impact',
//     'Group/Team Culture'
// ]
// let objReportDate = {
//     0: {
//         input: 8,
//         inputProgress: 10,
//         maxInput: 10,
//         maxInputProgress: 10,
//         nameCard: arrayNameCard[0]
//     },
//     1: {
//         input: 8,
//         inputProgress: 9,
//         maxInput: 10,
//         maxInputProgress: 10,
//         nameCard: arrayNameCard[1]
//     },
//     2: {
//         input: 8,
//         inputProgress: 8,
//         maxInput: 10,
//         maxInputProgress: 10,
//         nameCard: arrayNameCard[2]
//     },
//     3: {
//         input: 8,
//         inputProgress: 8,
//         maxInput: 10,
//         maxInputProgress: 10,
//         nameCard: arrayNameCard[3]
//     },
//     4: {
//         input: 9,
//         inputProgress: 7,
//         maxInput: 10,
//         maxInputProgress: 10,
//         nameCard: arrayNameCard[4]
//     },
//     5: {
//         input: 8,
//         inputProgress: 6,
//         maxInput: 10,
//         maxInputProgress: 10,
//         nameCard: arrayNameCard[5]
//     },
//     6: {
//         input: 7,
//         inputProgress: 5,
//         maxInput: 10,
//         maxInputProgress: 10,
//         nameCard: arrayNameCard[6]
//     },
//     7: {
//         input: 9,
//         inputProgress: 4,
//         maxInput: 10,
//         maxInputProgress: 10,
//         nameCard: arrayNameCard[7]
//     },
//     8: {
//         input: 6,
//         inputProgress: 3,
//         maxInput: 10,
//         maxInputProgress: 10,
//         nameCard: arrayNameCard[8]
//     },
//     9: {
//         input: 7,
//         inputProgress: 3,
//         maxInput: 10,
//         maxInputProgress: 10,
//         nameCard: arrayNameCard[9]
//     },
//     10: {
//         input: 8,
//         inputProgress: 1,
//         maxInput: 10,
//         maxInputProgress: 10,
//         nameCard: arrayNameCard[10]
//     }
// }
// for(let i = 0; i <= 10; i++) {
//     test4(i)
//     let formGapReport = $(`.${i}`)
//     let target = formGapReport.get(0).querySelector('.target')
//     let limit = formGapReport.get(0).querySelector('.limit')
//     let progress = formGapReport.get(0).querySelector('.progress-done')
//     let out1 = formGapReport.get(0).querySelector(".panel-report-degrees");
//     let out2 = formGapReport.get(0).querySelector(".panel-report-name");
//     let out3 = formGapReport.get(0).querySelector(".panel-report-rates");
//     let finalValue = 0
//     let max = 0;
//
//     // console.log(`${i})`,'objReportDate: ',objReportDate[i]);
//
//     setMaxWidth();
//
//     function setMaxWidth() {
//         max = parseInt(objReportDate[i].maxInput, 10);
//         max = parseInt(objReportDate[i].maxInputProgress, 10);
//
//         setLimit()
//     }
//     function setLimit() {
//         finalValue = parseInt(objReportDate[i].input, 10);
//         changeWidth(target)
//         changeWidth(limit)
//         setTarget()
//     }
//     function setTarget() {
//         finalValue = parseInt(objReportDate[i].inputProgress, 10);
//         changeWidth(progress)
//     }
//
//     function changeWidth(obj) {
//         obj.style.width = `${(finalValue / max) * 100}%`;
//         out()
//     }
//
//     function out() {
//         out2.innerHTML = `${objReportDate[i].nameCard}`;
//         if(objReportDate[i].input === objReportDate[i].inputProgress) {
//             out1.innerHTML = `${objReportDate[i].input}`;
//             out3.innerHTML = '✓';
//
//             if(objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.7) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 1)) {
//                 limit.style.borderRightWidth = "2px";
//                 limit.style.borderRightStyle = "solid";
//                 limit.style.borderRightColor = "#10582D";
//                 target.style.background = "rgba(0,255,100,0.1)";
//                 progress.style.background =
//                     "linear-gradient(269.49deg, "
//                     + '#55D98A 2.94%'
//                     + ", "
//                     + '#B6EDB1 61.71%'
//                     + ", "
//                     + 'rgba(213, 243, 189, 0.86) 127.35%'
//                     + ")";
//             } else if(objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.4) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.7)) {
//                 limit.style.borderRightWidth = "2px";
//                 limit.style.borderRightStyle = "solid";
//                 limit.style.borderRightColor = "#D88E20";
//                 target.style.background = "rgba(255,202,0,0.1)";
//                 progress.style.background =
//                     "linear-gradient(269.49deg, "
//                     + 'rgba(255, 148, 50, 0.97) -19.19%'
//                     + ", "
//                     + 'rgba(252, 182, 77, 0.97) 9.81%'
//                     + ", "
//                     + 'rgba(250, 209, 105, 0.36) 61.71%'
//                     + ", "
//                     + 'rgba(255, 246, 213, 0.19) 127.35%'
//                     + ")";
//             } else if(objReportDate[i].inputProgress > (objReportDate[i].maxInput * 0.2) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.4)) {
//                 limit.style.borderRightWidth = "2px";
//                 limit.style.borderRightStyle = "solid";
//                 limit.style.borderRightColor = "#5e5e5e";
//                 target.style.background = "rgba(187,187,187,0.1)";
//                 progress.style.background =
//                     "linear-gradient(269.49deg, "
//                     + '#BFBFBF -5.46%'
//                     + ", "
//                     + 'rgba(206, 206, 206, 0.373563) 77.74%'
//                     + ", "
//                     + 'rgba(241, 241, 241, 0) 127.35%'
//                     + ")";
//             } else if(objReportDate[i].inputProgress >= 0 && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.2)) {
//                 limit.style.borderRightWidth = "2px";
//                 limit.style.borderRightStyle = "solid";
//                 limit.style.borderRightColor = "#0A8899";
//                 target.style.background = "rgba(0,226,255,0.1)";
//                 progress.style.background =
//                     "linear-gradient(269.49deg, "
//                     + '#63E4F4 -19.19%'
//                     + ", "
//                     + '#7CDEEB 9.81%'
//                     + ", "
//                     + '#C5F7FC 61.71%'
//                     + ", "
//                     + '#F0FEFF 127.35%'
//                     + ")";
//             }
//
//         } else {
//             out1.innerHTML = `${objReportDate[i].inputProgress}` + '/' + `${objReportDate[i].input}`;
//
//             if(objReportDate[i].inputProgress > objReportDate[i].input) {
//                 let a = objReportDate[i].input;
//                 let b = objReportDate[i].inputProgress;
//                 let c = b - a;
//                 out3.innerHTML = `${c}`;
//             } else if(objReportDate[i].inputProgress < objReportDate[i].input) {
//                 let a = objReportDate[i].input;
//                 let b = objReportDate[i].inputProgress;
//                 let c = a - b
//                 out3.innerHTML = `${c * (-1)}`;
//             }
//             if(objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.7) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 1)) {
//                 limit.style.borderRightWidth = "2px";
//                 limit.style.borderRightStyle = "solid";
//                 limit.style.borderRightColor = "#10582D";
//                 target.style.background = "rgba(0,255,100,0.1)";
//                 progress.style.background =
//                     "linear-gradient(269.49deg, "
//                     + '#55D98A 2.94%'
//                     + ", "
//                     + '#B6EDB1 61.71%'
//                     + ", "
//                     + 'rgba(213, 243, 189, 0.86) 127.35%'
//                     + ")";
//             } else if(objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.4) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.7)) {
//                 limit.style.borderRightWidth = "2px";
//                 limit.style.borderRightStyle = "solid";
//                 limit.style.borderRightColor = "#D88E20";
//                 target.style.background = "rgba(255,202,0,0.1)";
//                 progress.style.background =
//                     "linear-gradient(269.49deg, "
//                     + 'rgba(255, 148, 50, 0.97) -19.19%'
//                     + ", "
//                     + 'rgba(252, 182, 77, 0.97) 9.81%'
//                     + ", "
//                     + 'rgba(250, 209, 105, 0.36) 61.71%'
//                     + ", "
//                     + 'rgba(255, 246, 213, 0.19) 127.35%'
//                     + ")";
//             } else if(objReportDate[i].inputProgress > (objReportDate[i].maxInput * 0.2) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.4)) {
//                 limit.style.borderRightWidth = "2px";
//                 limit.style.borderRightStyle = "solid";
//                 limit.style.borderRightColor = "#5e5e5e";
//                 target.style.background = "rgba(187,187,187,0.1)";
//                 progress.style.background =
//                     "linear-gradient(269.49deg, "
//                     + '#BFBFBF -5.46%'
//                     + ", "
//                     + 'rgba(206, 206, 206, 0.373563) 77.74%'
//                     + ", "
//                     + 'rgba(241, 241, 241, 0) 127.35%'
//                     + ")";
//             } else if(objReportDate[i].inputProgress >= 0 && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.2)) {
//                 limit.style.borderRightWidth = "2px";
//                 limit.style.borderRightStyle = "solid";
//                 limit.style.borderRightColor = "#0A8899";
//                 target.style.background = "rgba(0,226,255,0.1)";
//                 progress.style.background =
//                     "linear-gradient(269.49deg, "
//                     + '#63E4F4 -19.19%'
//                     + ", "
//                     + '#7CDEEB 9.81%'
//                     + ", "
//                     + '#C5F7FC 61.71%'
//                     + ", "
//                     + '#F0FEFF 127.35%'
//                     + ")";
//             }
//         }
//     }
// }