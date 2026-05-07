<?php
// Hardcoded tech stack for immediate hero impact
$row1 = ['HTML', 'CSS', 'JavaScript', 'React', 'Angular', 'ASP.NET'];
$row2 = ['Flutter', 'GSAP', 'MySQL', 'SQL Server', 'Tailwind', 'TypeScript'];

// Duplicate rows for infinite scroll effect
$row1_display = array_merge($row1, $row1, $row1);
$row2_display = array_merge($row2, $row2, $row2);
?>

<!-- Tech Stack Section -->
<section id="tech-stack" class="py-20 bg-gray-50 overflow-hidden border-t border-gray-200">
  <div class="text-center mb-12">
    <p class="text-gray-500 font-medium">Powering experiences with modern technologies</p>
  </div>

  <div class="flex flex-col gap-8">
    <!-- Row 1 -->
    <div class="flex overflow-hidden relative w-full">
      <div id="tech-row-1" class="flex w-max">
        <?php foreach ($row1_display as $tech): ?>
          <div class="flex items-center gap-2 px-6 py-3 bg-white rounded-full border border-gray-100 shadow-sm mx-4 whitespace-nowrap">
            <div class="w-2 h-2 rounded-full bg-google-blue"></div>
            <span class="font-display font-bold text-gray-700 text-lg"><?php echo $tech; ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Row 2 -->
    <div class="flex overflow-hidden relative w-full">
      <div id="tech-row-2" class="flex w-max">
        <?php foreach ($row2_display as $tech): ?>
          <div class="flex items-center gap-2 px-6 py-3 bg-white rounded-full border border-gray-100 shadow-sm mx-4 whitespace-nowrap">
            <div class="w-2 h-2 rounded-full bg-google-red"></div>
            <span class="font-display font-bold text-gray-700 text-lg"><?php echo $tech; ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Row 1 moves Left
        gsap.to("#tech-row-1", {
            xPercent: -50,
            repeat: -1,
            duration: 25,
            ease: "linear"
        });

        // Row 2 moves Right
        gsap.fromTo("#tech-row-2", 
            { xPercent: -50 },
            {
                xPercent: 0,
                repeat: -1,
                duration: 25,
                ease: "linear"
            }
        );
    });
</script>
