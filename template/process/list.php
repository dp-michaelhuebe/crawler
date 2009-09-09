<?php if (!defined('TYPO3_MODE')) die ('Access denied.'); ?>

<span style="padding-left: 5px;">
	<?php echo $this->getRefreshLink(); ?>
	<?php echo $this->getEnableDisableLink(); ?>
	<?php echo $this->getAddLink(); ?>
	<?php echo $this->getModeLink(); ?>
</span>

<?php if($this->getActionMessage() != ''): ?>
	<div id="message">
		<?php echo $this->getActionMessage(); ?>
	</div>
<?php endif; ?>

<h2><?php echo $this->getLLLabel('LLL:EXT:crawler/modfunc1/locallang.php:labels.generalinformation'); ?>:</h2>
<table>
	<tr>
		<td><?php echo $this->getLLLabel('LLL:EXT:crawler/modfunc1/locallang.php:labels.pendingoverview'); ?>:</td>
		<td><?php echo htmlspecialchars($this->getAssignedUnprocessedItemCount()); ?> / <?php echo htmlspecialchars($this->getTotalUnprocessedItemCount()); ?>  </td>
	</tr>
	<tr>
		<td><?php echo $this->getLLLabel('LLL:EXT:crawler/modfunc1/locallang.php:labels.curtime'); ?>:</td>
		<td><?php echo $this->asDate(time()); ?></td>
	</tr>
	<tr>
		<td><?php echo $this->getLLLabel('LLL:EXT:crawler/modfunc1/locallang.php:labels.processcount'); ?></td>
		<td><?php echo htmlspecialchars($this->getActiveProcessCount()); ?> / <?php echo htmlspecialchars($this->getMaxActiveProcessCount()); ?></td>
	</tr>
	<tr>
		<td><?php echo $this->getLLLabel('LLL:EXT:crawler/modfunc1/locallang.php:labels.clipath'); ?>:</td>
		<td><?php echo htmlspecialchars($this->getCliPath()); ?></td>
	</tr>
</table>

<h2><?php echo $this->getLLLabel('LLL:EXT:crawler/modfunc1/locallang.php:labels.processstates'); ?>: </h2>
<table class="processes">
	<thead>
		<tr>
			<th><?php echo $this->getLLLabel('LLL:EXT:crawler/modfunc1/locallang.php:labels.state'); ?>: </th>
			<th><?php echo $this->getLLLabel('LLL:EXT:crawler/modfunc1/locallang.php:labels.processid'); ?>: </th>
			<th><?php echo $this->getLLLabel('LLL:EXT:crawler/modfunc1/locallang.php:labels.time.first'); ?>: </th>
			<th><?php echo $this->getLLLabel('LLL:EXT:crawler/modfunc1/locallang.php:labels.time.last'); ?>: </th>
			<th><?php echo $this->getLLLabel('LLL:EXT:crawler/modfunc1/locallang.php:labels.time.duration'); ?>: </th>
			<th><?php echo $this->getLLLabel('LLL:EXT:crawler/modfunc1/locallang.php:labels.ttl'); ?>: </th>
			<th><?php echo $this->getLLLabel('LLL:EXT:crawler/modfunc1/locallang.php:labels.status.current'); ?>: </th>
			<th><?php echo $this->getLLLabel('LLL:EXT:crawler/modfunc1/locallang.php:labels.status.initial'); ?>:</th>
			<th><?php echo $this->getLLLabel('LLL:EXT:crawler/modfunc1/locallang.php:labels.status.finally'); ?>:</th>
			<th><?php echo $this->getLLLabel('LLL:EXT:crawler/modfunc1/locallang.php:labels.status.progress'); ?>: </th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($this->getProcessCollection() as $process): /* @var $process tx_crawler_domain_process */ ?>
			<tr class="<?php echo (++$count % 2 == 0) ? 'odd': 'even' ?>">
				<td><?php echo $this->getIconForState(htmlspecialchars($process->getState())); ?></td>
				<td><?php echo htmlspecialchars($process->getProcess_id()); ?></td>
				<td><?php echo htmlspecialchars($this->asDate($process->getTimeForFirstItem())); ?></td>
				<td><?php echo htmlspecialchars($this->asDate($process->getTimeForLastItem())); ?></td>
				<td><?php echo htmlspecialchars(floor($process->getRuntime()/ 60)); ?> min. <?php echo htmlspecialchars($process->getRuntime()) % 60 ?> sec.</td>
				<td><?php echo htmlspecialchars($this->asDate($process->getTTL())); ?></td>
				<td><?php echo htmlspecialchars($process->countItemsProcessed()); ?></td>
				<td><?php echo htmlspecialchars($process->countItemsAssigned()); ?></td>
				<td><?php echo htmlspecialchars($process->countItemsToProcess()+$process->countItemsProcessed()); ?></td>
				<td>
				<?php if ($process->getState() == 'running'): ?>
					<div class="crawlerprocessprogress" style="width: 200px;">
						<div class="crawlerprocessprogress-bar" style="width: <?php echo $process->getProgress(); ?>%" ></div>
						<div class="crawlerprocessprogress-label"><?php echo $process->getProgress(); ?> %</div>
					</div>
				<?php elseif ($process->getState() == 'cancelled'): ?>
					<?php echo $this->getLLLabel('LLL:EXT:crawler/modfunc1/locallang.php:labels.process.cancelled'); ?>
				<?php else: ?>
					<?php echo $this->getLLLabel('LLL:EXT:crawler/modfunc1/locallang.php:labels.process.success'); ?>
				<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<br />